<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\UserNotification;
use App\Models\User;

class JobController extends Controller
{
    public function activeJobs(){
    	$pageTitle = "Active Jobs";
    	$jobs = JobPost::where('status','active')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }
    public function pendingJobs(){
    	$pageTitle = "Pending Jobs";
    	$jobs = JobPost::where('status','pending')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }
    public function completedJobs(){
    	$pageTitle = "Completed Jobs";
    	$jobs = JobPost::where('status','complete')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }
    public function rejectedJobs(){
    	$pageTitle = "Rejected Jobs";
    	$jobs = JobPost::where('status','reject')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }


    public function deletejob($id)
    {

      $job = JobPost::findOrFail($id);

      if ($job->submitjobs()->exists()) {
        return back()->with('error','This job Cannot delete because submit jobs exist under it');
      }
      
      $budget = $job->budget;
      $parcentage = $job->charge_percentage;

      $charge = ($budget*$parcentage)/100;

      $total_with_charge = $budget+$charge;

      $user = User::where('id',$job->user_id)->first();
      $user->increment('current_deposit',$total_with_charge);

       UserNotification::create([
                'user_id' => $job->user_id,
                'message' => $job->code ." job has been rejected. and $". $total_with_charge . " has ben refund",
                'status'  => 'pending',
            ]);
          

      
         $job->delete();
 
        return back()->with('success', 'Job deleted successfully');
    }
}
