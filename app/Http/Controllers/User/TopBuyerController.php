<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobPost;
use Auth;

class TopBuyerController extends Controller
{
     public function index(){
         
      $topbuyers = User::orderBy('total_job_post','desc')->take(20)->get();
      
	  return view('top-buyer.index',compact('topbuyers'));
     }
  
}
