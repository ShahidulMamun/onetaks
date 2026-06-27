<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSubmit;
use Auth;
class FinishJobController extends Controller
{
     // finished jobs
    public function finishedJobs(){



    	$submitjobs = JobSubmit::where('user_id',Auth::user()->id)->with(['job','jobowner'])->orderBy('id','desc')->get();
    	$totalSubmit = $submitjobs->count();
		$pendingCount  = $submitjobs->where('status', 'pending')->count();
		$rejectedCount = $submitjobs->where('status', 'rejected')->count();
		$approvedCount = $submitjobs->where('status', 'approved')->count();

        return view('user.finished_job',compact('submitjobs','pendingCount','rejectedCount','approvedCount','totalSubmit'));
    }
  
    
}
