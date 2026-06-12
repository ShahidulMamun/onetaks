<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TopFreelancerController extends Controller
{
    public function index(){

    	 $topfreelancers = User::orderBy('total_earning','desc')->take(20)->get();
    	return view('top-freelancer.index',compact('topfreelancers'));
    }
}
