<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;

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
    	$jobs = JobPost::where('status','active')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }
    public function rejectedJobs(){
    	$pageTitle = "Rejected Jobs";
    	$jobs = JobPost::where('status','active')->with('user')->paginate(10);
    	return view('admin.jobs.index',compact(['jobs','pageTitle']));
    }
}
