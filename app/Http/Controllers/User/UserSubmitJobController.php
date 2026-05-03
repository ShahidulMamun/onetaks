<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\UserNotification;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserSubmitJobController extends Controller
{
    public function storeSubmitjob(Request $request, $code,$slug){

       // return $request->all();

	    // ✅ Validation
	    $request->validate([

	    	// 'job_id' => ['required','exists:job_posts,id'],
	        'texts'   => ['nullable', 'array'],
	        'texts.*' => ['nullable', 'string', 'max:100'],
	        'images'   => ['nullable', 'array'],
	        'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'], // 2MB
	    ]);

	   $job = JobPost::where('code',$code)->first();

       if (!$job) {
        return back()->with('error','Invalid Request');
       }

       if($job->worker_need==0){
       	 return back()->with('error','No worker need this job');
       }

       if($job->status !=='active'){
       	 return back()->with('error','This job not available');
       }

       if($job->has_secret_code==1){

       	 $request->validate([
    	 'secret_code' =>['required','exists:job_posts,secret_code'],
        ]);
         
         if ($job->secret_code !== $request->secret_code) {
           return back()->with('error','Secret code not match');
         }

         $authuser = Auth::user();
         $authuser->increment('current_earning',$job->worker_earn);

        }

        $job->increment('worker_done',1);
        $job->decrement('worker_remaining',1);

   

    // DB::beginTransaction();

    // try {

        
        $texts = [];
		if ($request->filled('texts')) {
		    foreach ($request->texts as $text) {
		        if (!empty($text)) {
		            $texts[] = strip_tags($text);
		        }
		    }
		}

		$images = [];
		if ($request->hasFile('images')) {
		    foreach ($request->file('images') as $file) {
		        if ($file) {
		            $name = uniqid() . '.' . $file->getClientOriginalExtension();
		            $path = $file->storeAs('proofs', $name, 'public');
		            $images[] = $path;
		        }
		    }
		}

        // submit job
        DB::table('job_submits')->insert([
        	'job_id'  => $job->id,
            'user_id' => auth()->user()->id,
            'job_owner_user_id' => $job->user_id,
            'proof_text'  => !empty($texts) ? json_encode($texts) : null,
            'proof_image' => !empty($images) ? json_encode($images) : null,
            'submitted_code'=>$request->secret_code ?? '',
            'created_at' => now(),
        ]);

            //notification for job owner
            $message = $job->code." job has been submitted";
            UserNotification::create([
                'user_id' => $job->user_id,
                'message' => $message,
                'status'  => 'pending',
            ]);

        DB::commit();

        return back()->with('success', 'Proof submitted successfully');

    //  } catch (\Exception $e) {

    //     DB::rollBack();

    //     return back()->with('error', 'Something went wrong');
    // }
  }
}
