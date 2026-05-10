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
        return view('user.finished_job',compact('submitjobs'));
    }
  
    
}
