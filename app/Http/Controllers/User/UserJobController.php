<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\UserNotification;
use App\Models\UserTransaction;
use App\Models\WebsiteSetting;
use App\Models\Continent;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\JobPost;
use App\Models\Banner;
use App\Models\User;


class UserJobController extends Controller
{
    // ── GET /user/create-job ──────────────────────────────────────────
    public function create()
    {
        $setting = WebsiteSetting::first();
        return view('user.jobs.create',compact('setting'));
    }

    // ── GET /user/continents ──────────────────────────────────────────
    public function continents(): JsonResponse
    {
        $continents = Continent::where('is_active', true)
            ->withCount('countries as country_count')
            ->orderBy('name')
            ->get(['id', 'name', 'code', 'emoji'])
            ->map(function ($c) {
                $c->name  = strip_tags($c->name);
                $c->code  = strtoupper(strip_tags($c->code));
                $c->emoji = $c->emoji ?: '';
                return $c;
            });

        return response()->json($continents);
    }

    // ── GET /user/continents/{id}/countries ───────────────────────────
    public function countries(int $id): JsonResponse
    {
        $continent = Continent::findOrFail($id);

        $countries = $continent->countries()
            ->get(['id', 'name', 'code'])
            ->map(function ($c) {
                $c->name = strip_tags($c->name);
                $c->code = strtoupper(strip_tags($c->code));
                return $c;
            });

        return response()->json($countries);
    }

    // ── GET /user/job-categories ──────────────────────────────────────
    public function categories(): JsonResponse
    {
        $categories = Category::where('is_active', true)
            ->withCount('subcategories as sub_count')
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(function ($c) {
                $c->name = strip_tags($c->name);
                return $c;
            });

        return response()->json($categories);
    }

    // ── GET /user/job-categories/{id}/subcategories ───────────────────
    public function subcategories(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $subs = $category->subcategories()
            ->get(['id', 'name', 'minimum_cost'])
            ->map(function ($s) {
                $s->name = strip_tags($s->name);
                return $s;
            });

        return response()->json($subs);
    }

    public function store(Request $request)
    {
        
          // return $request->all();
       $request->validate([
            'continent_id'   => 'required|exists:continents,id',
            'country_id'     => 'required|exists:countries,id',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'worker_need'    => 'required|integer|min:1',
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_secret_code'=> 'boolean',
            'secret_code'    => 'required_if:has_secret_code,1|nullable|string|max:20',
            'secret_code_example'    => 'required_if:has_secret_code,1|nullable|string|max:20',
            'proofs'         => 'required|array|min:1',
            'proofs.*.type'  => 'required|in:text,file',
            'proofs.*.label' => 'required|string|max:255',
        ]);
        
        // //validation fail message error
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        //fetch subcategory price
        $subcategory = SubCategory::findOrFail($request->subcategory_id);

        if (!$subcategory) {
          return  back()->with('error','Invalid Category');
        }

        $each_work_price = $subcategory->minimum_cost;
        
        $worker_need = $request->worker_need;
        $cost = $worker_need*$each_work_price;
        
        //fetch job post charge
        $setting = WebsiteSetting::first();
        $charge = $setting->jobpost_charge;
        $total_charge = ($cost*$charge)/100;

         $total_cost_with_charge = $cost+$total_charge;

         $user = Auth::user();

         $deposit = $user->current_deposit;

         if ($total_cost_with_charge>$deposit){
            return  back()->with('error','You have not enough deposit');
         }





        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('job-thumbnails', 'public');
        }


        $slug = Str::slug($request->title);

        if (JobPost::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . uniqid();
        }

        $job = JobPost::create([
            'user_id'        => $user->id,
            'continent_id'   => $request->continent_id,
            'country_id'     => $request->country_id,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title'          => $request->title,
            'code'           =>  strtoupper(Str::random(10)),
            'slug'           => $slug,
            'description'    => $request->description,
            'thumbnail'      => $thumbnailPath,
            'worker_need'    => $request->worker_need,
            'worker_remaining'=> $request->worker_need,
            'budget'         => $cost,
            'worker_earn'    => $each_work_price,
            'charge_percentage'=>$charge,
            'has_secret_code'=> $request->boolean('has_secret_code'),
            'secret_code'    => $request->boolean('has_secret_code') ? $request->secret_code : null,
            'secret_code_example'=>$request->secret_code_example ?? null,
            'proofs'         => $request->proofs,
        ]);

        if($job){
          $user->decrement('current_deposit', $total_cost_with_charge);
          $user->increment('total_job_post',1); 
            //user notification
            $title = "Job posted";
            $message = "$".$total_cost_with_charge." has been deducted for job posting (including charge).";
            UserNotification::create([
                'user_id' => $user->id,
                'title'   =>$title,
                'message' => $message,
                'status'  => 'pending',
            ]);

            //job post paymnet transaction
             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "jobpost_payment",
            'amount' => $cost,
            'description' => "Job post cost has been deducted",
            'reference_id' => "Job ID ".$job->id,
            'status' => 'success',
           ]);
           
           
            //job post charge transaction
             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "jobpost_charge",
            'amount' => $total_charge,
            'description' => "Job post charge has been deducted",
            'reference_id' => "Job ID ".$job->id,
            'status' => 'success',
           ]);
         }


        return back()->with('success','Job posted successfully and pending for approval');

   }

   public function update(Request $request, $id)
  {
        // ১. Validation — thumbnail nullable, বাকিগুলো required
        $request->validate([
            'extra_workers'   => 'required|integer|min:1|max:5000',
            'job_title'       => 'required|string|max:255',
            'job_description' => 'required|string|max:5000',
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ২. Job ownership check (existence + ownership verify — lock এখনও না)
        $job = JobPost::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        // ৩. Sanitize input — trim + strip_tags দিয়ে XSS/extra whitespace ঠেকানো
        $newTitle       = trim(strip_tags($request->job_title));
        $newDescription = trim(strip_tags($request->job_description));

        if ($newTitle === '' || $newDescription === '') {
            return back()->with('error', 'Title and description cannot be empty.');
        }

        // ৪. Change detection (initial snapshot দিয়ে — UX hint হিসেবে; authoritative status decision transaction-এর ভিতরে আবার হবে)
        $titleChanged       = $job->title !== $newTitle;
        $descriptionChanged = $job->description !== $newDescription;
        $thumbnailChanged   = $request->hasFile('thumbnail');

        // ৫. Status decide: কোনো content change হলে pending, শুধু worker বাড়ালে active
        $status = ($titleChanged || $descriptionChanged || $thumbnailChanged) ? 'pending' : 'active';

        

        // ৬. Charge calculation
        $setting           = Websitesetting::first();
        $extraWorkers       = (int) $request->extra_workers;
        $workerEarn         = (float) $job->worker_earn;
        $new_budget         = $extraWorkers * $workerEarn;
        $charge_parcantage  = (float) ($setting->jobpost_charge ?? 0);
        $charge             = round(($new_budget * $charge_parcantage) / 100, 2);
        $totalCharge        = round($new_budget + $charge, 2);

        //message define 
        $message = $status === 'pending' ? 'Job updated and sent for review.' : $extraWorkers . ' workers added successfully.';

        // ৭. Early deposit check — fast UX feedback, file upload করার আগেই (authoritative check নয়, সেটা নিচে lock নিয়ে হবে)
        $user = Auth::user();
        if ($user->current_deposit < $totalCharge) {
            return back()->with('error', 'Insufficient deposit. Required: $' . number_format($totalCharge, 2));
        }

        // ৮. নতুন thumbnail upload করো (যদি দেওয়া থাকে) — পুরনোটা এখনও মুছবে না
        $newThumbnailPath = null;
        if ($thumbnailChanged) {
            try {
                $newThumbnailPath = $request->file('thumbnail')->store('job-thumbnails', 'public');
            } catch (\Exception $e) {
                Log::error('Thumbnail upload failed for job ' . $job->id . ': ' . $e->getMessage());
                return back()->with('error', 'Thumbnail upload failed. Please try again.');
            }
        }

        $oldThumbnailPath = $job->thumbnail; // রোলব্যাক/cleanup-এর জন্য রেফারেন্স রাখা

        // ৯. DB transaction — row-level lock + authoritative checks + সব DB write (job, deposit, notification, transaction records) একসাথে atomic
        try {
            DB::transaction(function () use (
                $job, $user, $extraWorkers, $totalCharge, $new_budget, $charge,
                $newTitle, $newDescription, $status,
                $newThumbnailPath, $thumbnailChanged
            ) {
                // Race-condition-safe: fresh row lock নিয়ে আবার পড়ো, পুরনো $job/$user object না
                $lockedJob  = JobPost::where('id', $job->id)->lockForUpdate()->first();
                $lockedUser = User::where('id', $user->id)->lockForUpdate()->first();

                if (!$lockedJob || !$lockedUser) {
                    throw new \RuntimeException('record_not_found');
                }

                // Authoritative deposit check — fresh balance দিয়ে, lock নেওয়ার পরে
                if ($lockedUser->current_deposit < $totalCharge) {
                    throw new \RuntimeException('insufficient_deposit');
                }
                
                $lockedJob->worker_need += $extraWorkers;
                $lockedJob->worker_remaining += $extraWorkers;
                $lockedUser->current_deposit -= $totalCharge;

                $lockedJob->title       = $newTitle;
                $lockedJob->description = $newDescription;
                $lockedJob->status      = $status;

                if ($thumbnailChanged) {
                    $lockedJob->thumbnail = $newThumbnailPath;
                }

                $lockedJob->save();
                $lockedUser->save();

                // ── Notification + transaction records — একই atomic transaction-এর অংশ ──
                UserNotification::create([
                    'user_id' => $lockedUser->id,
                    'title'   => "Job update",
                    'message' => "$" . number_format($totalCharge, 2) . " has been deducted for edit " . $lockedJob->code . " job (including charge).",
                    'status'  => 'pending',
                ]);

                UserTransaction::create([
                    'user_id'        => $lockedUser->id,
                    'transaction_id' => strtoupper(Str::uuid()),
                    'type'           => "jobpost_payment",
                    'amount'         => $new_budget,
                    'description'    => "Job edit cost has been deducted",
                    'reference_id'   => "Job ID " . $lockedJob->id,
                    'status'         => 'success',
                ]);

                UserTransaction::create([
                    'user_id'        => $lockedUser->id,
                    'transaction_id' => strtoupper(Str::uuid()),
                    'type'           => "jobpost_charge",
                    'amount'         => $charge,
                    'description'    => "Job edit charge has been deducted",
                    'reference_id'   => "Job ID " . $lockedJob->id,
                    'status'         => 'success',
                ]);
            });
        } catch (\RuntimeException $e) {
            // নতুন uploaded ফাইল cleanup করো (orphan file ঠেকাতে)
            if ($thumbnailChanged && $newThumbnailPath && Storage::disk('public')->exists($newThumbnailPath)) {
                Storage::disk('public')->delete($newThumbnailPath);
            }

            if ($e->getMessage() === 'insufficient_deposit') {
                return back()->with('error', 'Insufficient deposit. Required: $' . number_format($totalCharge, 2));
            }

            Log::error('Job update failed for job ' . $job->id . ': ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the job. Please try again.');
        } catch (\Exception $e) {
            if ($thumbnailChanged && $newThumbnailPath && Storage::disk('public')->exists($newThumbnailPath)) {
                Storage::disk('public')->delete($newThumbnailPath);
            }
            Log::error('Job update transaction failed for job ' . $job->id . ': ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the job. Please try again.');
        }

        // ১০. Transaction সফল হওয়ার পরই পুরনো thumbnail delete করো (filesystem op — DB rollback-এর সাথে সম্পর্কহীন, তাই transaction-এর বাইরে রাখা সঠিক)
        if ($thumbnailChanged && $oldThumbnailPath && Storage::disk('public')->exists($oldThumbnailPath)) {
            Storage::disk('public')->delete($oldThumbnailPath);
        }

        return back()->with('success', $message);
    }



   

   public function makeTopJob($id)
   {
    $job = JobPost::where('id', $id)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();
 
    if ($job->is_top) {
        return back()->with('error', 'This job is already a Top Job.');
    }
 
    $setting   = Websitesetting::first();
    $topCharge = (float) ($setting->topjob_charge ?? 0);
 
    $user = Auth::user();
    if ($user->current_deposit < $topCharge) {
        return back()->with('error', 'Insufficient balance. Required: $' . number_format($topCharge, 2));
    }
 
    DB::transaction(function () use ($job, $topCharge, $user) {
        $job->update([
        'is_top' => 1,
        'topped_at' => now(),
        ]);
        $user->decrement('current_deposit', $topCharge);
    });
            
            //user notification
            $title = "Job Top charge";
            $message = "$".$topCharge." has been deducted for ".$job->code." make top job";
            UserNotification::create([
                'user_id' => $user->id,
                'title'   =>$title,
                'message' => $message,
                'status'  => 'pending',
            ]);


             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "top_job_charge",
            'amount' => $topCharge,
            'description' => "Top job charge",
            'reference_id' => $job->id,
            'status' => 'success',
           ]);



 
    return back()->with('success', 'Job promoted to Top Job successfully!');
   }

    // my jobs
    public function myjobs(){
        $pageTitle= "My Jobs";
        $setting = WebsiteSetting::first();
        $jobs =  JobPost::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('user.jobs.my_job',compact('jobs','pageTitle','setting'));
    }

    // find jobs
    public function findjobs(){

         $userId = Auth::id();
 
         $banner = Banner::where('status', 'active')
        ->where('expired_at', '>', now())
        ->inRandomOrder()
        ->first();
        
        $submittedJobIds = DB::table('job_submits')
            ->where('user_id', $userId)
            ->pluck('job_id')
            ->toArray();
 
        // ── Base scope (সব query তে common) ──
        $baseQuery = JobPost::with('continent')
            ->where('status', 'active')
            // ->where('user_id', '!=', $userId)    
            ->whereNotIn('id', $submittedJobIds)     
            ->where('worker_remaining', '>', 0);    
 
      
        //  Boost jobs
        
        $boostedJobs = (clone $baseQuery)
            ->where('is_boosted', true)
            ->where('boosted_until', '>', now())
            ->orderBy('boosted_until', 'desc')   
            ->get();
 
  
        //   TOP jobs
    
        $topJobs = (clone $baseQuery)
            ->where('is_top', true)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
     
        //  NORMAL jobs
        $normalJobs = (clone $baseQuery)
            ->where('is_top', false)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
        // ── Priority order এ merge ──
        $jobs = $boostedJobs->concat($topJobs)->concat($normalJobs);
 
        $setting = WebsiteSetting::first();
 
        return view('user.dashboard', compact(
            'jobs',
            'boostedJobs',
            'topJobs',
            'normalJobs',
            'setting',
            'banner'
        ));
    }

    // job details
  public function details($code){
        
        $job = JobPost::where('code',$code)->first();

        //status check
        $status = $job->status;
        if ($status !== 'active') {

           return back()->with('error','This job not active');
        }

        //remaining worker check
        if ($job->worker_remaining==0) {
           return back()->with('error','This job is already complete');
        }

        return view('user.jobs.details',compact('job'));
    }

    public function delete($id,$code)
    {
     $job = JobPost::where('id',$id)->where('code',$code)->first();

    if(!$job) {
       return back()->with('error','Job id or code is invalid');
    }
    
     if ($job->user_id != Auth::user()->id) {

        abort(403, 'Unauthorized');
     }

     if($job->submitjobs()->exists()) {
        return back()->with('error','This job Cannot delete because submit jobs exist under it');
      }

          DB::transaction(function () use ($job) {

        $user = $job->user;

        // total remaining value
        $baseAmount = $job->worker_remaining * $job->worker_earn;
        // charge calculation
        $charge = ($baseAmount * $job->charge_percentage) / 100;

        // final refund
        $refundAmount = $baseAmount - $charge;

        // add to user deposit
        $user->increment('current_deposit',$refundAmount);
        
       //user notification
        $title = "Job Deleted";
        $message = "$".$refundAmount." has been refunded for ".$job->code . " deleted";
        UserNotification::create([
            'user_id' => $user->id,
            'title'   =>$title,
            'message' => $message,
            'status'  => 'pending',
        ]);


         UserTransaction::create([
        'user_id' => $user->id,
        'transaction_id' => strtoupper(uniqid()),
        'type' => "refund",
        'amount' => $refundAmount,
        'description' => "Jop deleted and deposit refunded",
        'reference_id' => $job->id,
        'status' => 'success',
        ]);


     });

    $job->delete();

    return redirect()->back()->with('success', 'Job deleted successfully!');
   }

    
  public function jobStopMoneyBack($id, $code)
  {
    $job = JobPost::where('id', $id)
        ->where('code', $code)
        ->first();

    if (!$job) {
        return back()->with('error', 'Job id or code is invalid');
    }

    if ($job->user_id != Auth::user()->id) {
        abort(403, 'Unauthorized');
    }

    // If already paused
    if ($job->status === 'stop') {
        return back()->with('error', 'Job is already stoped');
    }

    DB::transaction(function () use ($job) {

        $user = $job->user;

        // total remaining value
        $baseAmount = $job->worker_remaining * $job->worker_earn;
        // charge calculation
        $charge = ($baseAmount * $job->charge_percentage) / 100;

        // final refund
        $refundAmount = $baseAmount - $charge;

        // add to user deposit
        $user->increment('current_deposit',$refundAmount);
        // update job
        $job->update([
        'status' => 'stop',
        'worker_remaining' => 0,
        'worker_need' => 0,
    ]);

     //user notification
        $title = "Job stop deposit back";
        $message = "$".$refundAmount." has been refunded for ".$job->code . " stoped";
        UserNotification::create([
            'user_id' => $user->id,
            'title'   =>$title,
            'message' => $message,
            'status'  => 'pending',
        ]);


         UserTransaction::create([
        'user_id' => $user->id,
        'transaction_id' => strtoupper(uniqid()),
        'type' => "refund",
        'amount' => $refundAmount,
        'description' => "Jop stop and deposit refunded",
        'reference_id' => $job->id,
        'status' => 'success',
       ]);


    });

    return redirect()->back()->with('success', 'Job stoped successfully and refund added.');
}


  public function jobMute($id, $code)
  {
    $job = JobPost::where('id', $id)
        ->where('code', $code)
        ->first();

    if (!$job) {
        return back()->with('error', 'Job id or code is invalid');
    }

    if ($job->user_id != Auth::user()->id) {
        abort(403, 'Unauthorized');
    }

    // If already paused
    if ($job->status === 'mute') {
        return back()->with('error', 'Job is already Muted');
    }

    $job->update(['status'=>'mute']);


    return redirect()->back()->with('success', 'Job Muted successfully');
}

  public function jobUnmute($id, $code)
  {
    $job = JobPost::where('id', $id)
        ->where('code', $code)
        ->first();

    if (!$job) {
        return back()->with('error', 'Job id or code is invalid');
    }

    if ($job->user_id != Auth::user()->id) {
        abort(403, 'Unauthorized');
    }

    // If already paused
    if ($job->status === 'unmute') {
        return back()->with('error', 'Job is already unuted');
    }

    $job->update(['status'=>'active']);


    return redirect()->back()->with('success', 'Job unmute successfully');
}


   

}