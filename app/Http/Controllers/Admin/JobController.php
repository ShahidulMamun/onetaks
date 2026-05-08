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
    public function pausedJobs(){
      $pageTitle = "Paused Jobs";
      $jobs = JobPost::where('status','pause')->with('user')->paginate(10);
      return view('admin.jobs.index',compact(['jobs','pageTitle']));
    } 

    

   public function jobs(Request $request)
   {
    $query = JobPost::with(['user', 'category', 'subcategory']);

    // Search by title or code
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%'.$request->search.'%')
              ->orWhere('code', 'like', '%'.$request->search.'%');
        });
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by is_top
    if ($request->filled('is_top')) {
        $query->where('is_top', $request->is_top);
    }

    $jobs = $query->latest()->paginate(15);

    return view('admin.jobs.index', [
        'jobs'      => $jobs,
        'pageTitle' => 'All Jobs',
    ]);
   }


     public function approveJob($id){

       $job = JobPost::findOrFail($id);

      if ($job->status !== 'pending') {
        return back()->with('error','Something went wrong');
      }

     
      $job->status = 'active';
      $job->save();

      //user notification create
      $title = "Posted Job approveed";
      $message = $job->code." job has been approve";
      UserNotification::create([
                'user_id' => $job->user_id,
                'title'   =  $title;
                'message' => $message,
                'status'  => 'pending',
            ]);

       return back()->with('success', 'Job Approved successfully');

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
       
       //user notification create
       $title = "Posted job deleted";
       UserNotification::create([
                'user_id' => $job->user_id,
                'title'   => $title,
                'message' => $job->code ." job has been deleted. and $". $total_with_charge . " has ben refund",
                'status'  => 'pending',
            ]);
          

      
         $job->delete();
 
        return back()->with('success', 'Job deleted successfully');
    }

    public function rejectJob(Request $request, $id)
    {
      $request->validate(['reject_reason' => 'required|string|max:500']);
     
    $job = JobPost::findOrFail($id);

      $budget = $job->budget;
      $parcentage = $job->charge_percentage;

      $charge = ($budget*$parcentage)/100;

      $total_with_charge = $budget+$charge;

      $user = User::where('id',$job->user_id)->first();
      $user->increment('current_deposit',$total_with_charge);


       $job->update([
        'status'        => 'reject',
        'reject_reason' => $request->reject_reason,
       ]);

       //notification create
       $title = "Posted job rejected";
       UserNotification::create([
                'user_id' => $job->user_id,
                'title'   =>$title,
                'message' => $job->code ." job has been rejected. and $". $total_with_charge . " has ben refund",
                'status'  => 'pending',
            ]);

   
    return back()->with('success', 'Job rejected successfully.');
   }
  
   //make jon paused
   public function pauseJob($id)
   {
    $job = JobPost::findOrFail($id);

    if ($job->status !== 'active') {
        return back()->with('error', 'Only active jobs can be paused.');
    }

    $job->update(['status' => 'pause']);

    return back()->with('success', 'Job paused successfully.');
   }

   //make jon un paused
   public function liveJob($id)
   {
    $job = JobPost::findOrFail($id);

    if ($job->status !== 'pause') {
        return back()->with('error', 'Only paused jobs can be made live.');
    }

    $job->update(['status' => 'active']);

    return back()->with('success', 'Job is now active.');
   }


    public function detailsJob($id){

       $job = JobPost::findOrFail($id);

       return view('admin.jobs.details',compact('job'));
    }
}
