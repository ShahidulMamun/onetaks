<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotification;
use App\Models\UserTransaction;
use App\Models\JobSubmit;
use App\Models\JobPost;

class UserSubmitJobController extends Controller
{

public function storeSubmitjob(Request $request, $code, $slug)
{
    
    $job = JobPost::where('code', $code)->firstOrFail();

    $proofs  = collect($job->proofs);
    $hasText = $proofs->contains(fn($item) => $item['type'] === 'text');
    $hasFile = $proofs->contains(fn($item) => $item['type'] === 'file');

   //Validation
    $rules = [
        'texts'    => [$hasText ? 'required' : 'nullable', 'array'],
        'texts.*'  => [$hasText ? 'required' : 'nullable', 'string', 'max:100'],
        'images'   => [$hasFile ? 'required' : 'nullable', 'array'],
        'images.*' => [$hasFile ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
    ];

    $request->validate($rules);

    // ─── 4. Business rule checks (DB lock এর আগে দ্রুত bail-out) ────
    if ($job->status !== 'active') {
        return back()->with('error', 'This job is not available.');
    }

    if ($job->user_id === Auth::id()) {
        return back()->with('error', 'You cannot submit your own job.');
    }

    // ─── 5. Secret code pre-validation (lock নেওয়ার আগেই) ───────────
    if ($job->has_secret_code) {
        $request->validate(
            ['secret_code' => ['required']],
        );

        if ($job->secret_code !== $request->secret_code) {
            return back()->with('error', 'Secret code does not match.');
        }
    }

    // ─── 6. File upload (lock এর বাইরে — IO-heavy কাজ আগে করো) ─────
    $texts  = [];
    $images = [];

    if ($request->filled('texts')) {
        foreach ($request->texts as $text) {
            if (!empty($text)) {
                $texts[] = strip_tags($text);
            }
        }
    }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            if ($file) {
                $name     = uniqid() . '.' . $file->getClientOriginalExtension();
                $path     = $file->storeAs('proofs', $name, 'public');
                $images[] = $path;
            }
        }
    }

    // ─── 7. Transaction + pessimistic lock ───────────────────────────
    //  lockForUpdate() নিশ্চিত করে যে একটি request process হওয়ার সময়
    //  অন্য কোনো request একই row পড়তে বা পরিবর্তন করতে পারবে না।
    DB::beginTransaction();

    try {
        // Row-level lock — race condition সম্পূর্ণ বন্ধ হবে
        $job = JobPost::where('code', $code)
            ->lockForUpdate()
            ->firstOrFail();

        // Lock নেওয়ার পরে আবার validate করো (state বদলে যেতে পারে)
        if ($job->status !== 'active') {
            DB::rollBack();
            return back()->with('error', 'This job is not available.');
        }

        if ($job->worker_remaining <= 0) {
            DB::rollBack();
            return back()->with('error', 'No worker slots remaining for this job.');
        }

        // Duplicate submit check — lock এর ভেতরে হওয়া জরুরি
        $alreadySubmitted = DB::table('job_submits')
            ->where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadySubmitted) {
            DB::rollBack();
            return back()->with('error', 'You have already submitted this job.');
        }

        // ─── 8. Status ও earning নির্ধারণ ───────────────────────────
        $status   = 'pending';
        $authUser = Auth::user();

        if ($job->has_secret_code) {
            $authUser->increment('current_earning', $job->worker_earn);
            $authUser->increment('total_earning',   $job->worker_earn);
            $status = 'approved';
        }

        // ─── 9. Counter update ───────────────────────────────────────
        // decrement worker_remaining, increment worker_done — atomically
        $job->increment('worker_done',      1);
        $job->decrement('worker_remaining', 1);

        // worker_remaining শূন্য হলে job বন্ধ করো
        if (($job->worker_remaining - 1) <= 0) {
            $job->update(['status' => 'completed']);
        }

        // ─── 10. Submit insert ───────────────────────────────────────
        DB::table('job_submits')->insert([
            'job_id'              => $job->id,
            'user_id'             => Auth::id(),
            'job_owner_user_id'   => $job->user_id,
            'proof_text'          => !empty($texts)  ? json_encode($texts)  : null,
            'proof_image'         => !empty($images) ? json_encode($images) : null,
            'submitted_code'      => $request->secret_code ?? '',
            'status'              => $status,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        // ─── 11. Notification ────────────────────────────────────────
        UserNotification::create([
            'user_id' => $job->user_id,
            'title'   => 'Job Submitted',
            'message' => $job->code . ' job has been submitted.',
            'status'  => 'pending',
        ]);

        DB::commit();

        return back()->with('success', 'Proof submitted successfully.');

    } catch (\Exception $e) {
        DB::rollBack();

        // Upload হয়ে যাওয়া files মুছে দাও যদি transaction fail হয়
        foreach ($images as $imagePath) {
            \Storage::disk('public')->delete($imagePath);
        }

        \Log::error('Job submit failed: ' . $e->getMessage(), [
            'user_id' => Auth::id(),
            'job_code' => $code,
        ]);

        return back()->with('error',$e->getMessage());
    }
}
    public function proof($id,$code){
        
        
        // $job = JobPost::where('id',$id)->where('code',$code)->with('submitjobs.user')->first();
        
         $job = JobPost::where('id', $id)
                  ->where('code', $code)
                  ->with('continent')
                  ->firstOrFail();
      

         if(!$job) {
           return back()->with('error','Job id or code is invalid');
         }
        
         if ($job->user_id != Auth::id()) {
          abort(403);
         }
         
         $submissions = JobSubmit::with('user')
                    ->where('job_id', $job->id)
                    ->latest()
                    ->paginate(50);

     return view('user.submit_job.proof',compact('job','submissions'));
   }



   // public function submitReject(Request $request, $id)
   // {
   //    $request->validate([
   //        'reject_reason' =>'required|string|max:500',
   //    ]);

   //    $submission = JobSubmit::with('job')->find($id);

   //      if (!$submission) {

   //          return back()->with('error', 'Submission not found.');
   //      }

   //     $job = $submission->job;

   //      /* Security Check */
   //      if ($job->user_id != Auth::id()) {

   //          abort(403);
   //      }

   //      /* Already Processed */
   //      if ($submission->status !== 'pending') {

   //          return back()->with('error', 'This submission is already processed.');
   //      }
        
   //        /* Delete proof images */
   //      if (!empty($submission->proof_image)) {
   //          $images = is_array($submission->proof_image)
   //              ? $submission->proof_image
   //              : json_decode($submission->proof_image, true);

   //          if (is_array($images)) {
   //              foreach ($images as $image) {
   //                  Storage::disk('public')->delete($image); // 'proofs/filename.jpg'
   //              }
   //          }
   //      }


   //      $submission->update([
   //          'status' => 'rejected',
   //          'reject_reason' => $request->reject_reason,
   //          'rejected_at' => now(),

   //      ]);


   //      /* worker calculation */
   //      $job->decrement('worker_done',1);
   //      $job->increment('worker_remaining',1);
       
   //      if ($job->status=="completed") {
   //          $job->status = 'active';
   //          $job->save();
   //      }
       

    
   //      //notification for job owner
   //      $title = "Submit job rejected";
   //      $message = "Your Submission ".$job->code." this job has been rejected";
   //      UserNotification::create([
   //          'user_id' => $submission->user_id,
   //          'title'   => $title,
   //          'message' => $message,
   //          'status'  => 'pending',
   //      ]);

   //  return back()->with(
   //      'success',
   //      'Submission rejected successfully.'
   //  );
   // }

   public function submitReject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:500',
        ]);

        try {
            $submission = JobSubmit::with('job')->findOrFail($id); // auto 404

            $job = $submission->job;

            if (!$job) {
                return back()->with('error', 'Job not found.');
            }

            /* Security Check */
            if ($job->user_id != Auth::id()) {
                abort(403);
            }

            /* Already Processed */
            if ($submission->status !== 'pending') {
                return back()->with('error', 'This submission is already processed.');
            }

            DB::transaction(function () use ($submission, $job, $request) {

                $submission->update([
                    'status'        => 'rejected',
                    'reject_reason' => $request->reject_reason,
                    'rejected_at'   => now(),
                ]);

                /* Worker calculation (guarded against going below zero) */
                if ($job->worker_done > 0) {
                    $job->decrement('worker_done', 1);
                }
                $job->increment('worker_remaining', 1);

                if ($job->status === 'completed') {
                    $job->status = 'active';
                    $job->save();
                }

                /* Notify the worker */
                UserNotification::create([
                    'user_id' => $submission->user_id,
                    'title'   => 'Submit job rejected',
                    'message' => 'Your Submission ' . $job->code . ' this job has been rejected',
                    'status'  => 'pending',
                ]);
            });

            /* Delete proof images AFTER transaction succeeds */
            if (!empty($submission->proof_image)) {
                $images = is_array($submission->proof_image)
                    ? $submission->proof_image
                    : json_decode($submission->proof_image, true);

                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            return back()->with('success', 'Submission rejected successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Submission not found.');
        } catch (\Exception $e) {
            Log::error('submitReject failed: ' . $e->getMessage(), ['id' => $id]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

   public function submitApprove($id)
   {
    
    $submission = JobSubmit::with(['job', 'user'])->find($id);
    if (!$submission) {
        return back()->with('error', 'Submission not found.');
    }

    $job = $submission->job;

    /* Security Check */
    if ($job->user_id != Auth::id()) {
        abort(403);
    }

    /* Already Processed */
    if ($submission->status !== 'pending') {

        return back()->with('error', 'This submission is already processed.');
    }
    
      /* Delete proof images */
      if (!empty($submission->proof_image)) {
            $images = is_array($submission->proof_image)
                ? $submission->proof_image
                : json_decode($submission->proof_image, true);

            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image); // 'proofs/filename.jpg'
                }
            }
        }


    DB::transaction(function () use ($submission, $job) {

        /* Approve Submission */
        $submission->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);
        /* Worker Balance Add */
         $submission->user->increment('total_earning',$job->worker_earn);
        $submission->user->increment('current_earning',$job->worker_earn);
        
      
    });

    /* Notification for Worker */
    $title = "Submit job approved";
    $message = "Congratulations! Your submission for job ".$job->code." has been approved.";

    UserNotification::create([
        'user_id' => $submission->user_id,
        'title'   => $title,
        'message' => $message,
        'status'  => 'pending',
     ]);

      UserTransaction::create([
          'user_id' => $submission->user_id,
          'transaction_id' => strtoupper(uniqid()),
          'type' => "earning",
          'amount' => $job->worker_earn,
          'description' => "Earning from job submit",
          'reference_id' => $job->id,
          'status' => 'success',
        ]);

    return back()->with(
        'success',
        'Submission approved successfully.'
    );
  }
  
  public function submitApproveSelected(Request $request)
{
    $ids = $request->input('ids', []);
    if (empty($ids)) {
        return back()->with('error', 'No submissions selected.');
    }

    foreach ($ids as $id) {
        $submission = JobSubmit::with(['job', 'user'])->find($id);
        if (!$submission) continue;

        $job = $submission->job;
        if ($job->user_id != Auth::id()) continue;
        if ($submission->status !== 'pending') continue;

        if (!empty($submission->proof_image)) {
            $images = is_array($submission->proof_image)
                ? $submission->proof_image
                : json_decode($submission->proof_image, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        DB::transaction(function () use ($submission, $job) {
            $submission->update([
                'status' => 'approved',
                'approved_at' => now(),
            ]);
            $submission->user->increment('total_earning', $job->worker_earn);
            $submission->user->increment('current_earning', $job->worker_earn);
        });

        UserNotification::create([
            'user_id' => $submission->user_id,
            'title'   => "Submit job approved",
            'message' => "Congratulations! Your submission for job " . $job->code . " has been approved.",
            'status'  => 'pending',
        ]);

        UserTransaction::create([
            'user_id' => $submission->user_id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "earning",
            'amount' => $job->worker_earn,
            'description' => "Earning from job submit",
            'reference_id' => $job->id,
            'status' => 'success',
        ]);
    }

    return back()->with('success', 'Selected submissions approved successfully.');
}

}
