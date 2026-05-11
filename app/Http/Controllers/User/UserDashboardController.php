<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;

class UserDashboardController extends Controller
{
    public function userDashboard(){

        $jobs = JobPost::where('status','active')->orderBy('boosted_until','desc')->get();
        return view('user.dashboard',compact('jobs'));
    }
}
