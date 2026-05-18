<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;

class UserDashboardController extends Controller
{
    public function userDashboard(){

    $banner = Banner::where('status', 'active')
    ->where('expired_at', '>', now())
    ->inRandomOrder()
    ->first();

           $userId = Auth::id();
        
        //already submit check
        $submittedJobIds = DB::table('job_submits')
            ->where('user_id', $userId)
            ->pluck('job_id')
            ->toArray();
        
        // hide check
        $hiddenJobIds = DB::table('hide_jobs')
        ->where('user_id', $userId)
        ->pluck('job_id')
        ->toArray();
 
        // common query
        $baseQuery = JobPost::with('continent')
            ->where('status', 'active')
            // ->where('user_id', '!=', $userId)    
            ->whereNotIn('id', $submittedJobIds)
            ->whereNotIn('id', $hiddenJobIds)      
            ->where('worker_remaining', '>', 0);    
 
      
        //  Boost jobs
        $boostedJobs = (clone $baseQuery)
            ->where('is_boosted', true)
            ->where('boosted_until', '>', now())
            ->orderBy('boosted_until', 'desc')   
            ->get();
 
  
        //   top jobs
        $topJobs = (clone $baseQuery)
            ->where('is_top', true)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
     
        //  normal jobs
        $normalJobs = (clone $baseQuery)
            ->where('is_top', false)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
        // ── Priority order merge ──
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
}
