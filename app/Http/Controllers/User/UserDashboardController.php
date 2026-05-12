<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function userDashboard(){

           $userId = Auth::id();
 
        // ── এই user আগে যে job IDs submit করেছে ──
        // ⚠️ 'job_submissions' — আপনার actual table name দিন
        // ⚠️ 'job_id' — আপনার actual column name দিন
        $submittedJobIds = DB::table('job_submits')
            ->where('user_id', $userId)
            ->pluck('job_id')
            ->toArray();
 
        // ── Base scope (সব query তে common) ──
        $baseQuery = JobPost::with('continent')
            ->where('status', 'active')
            // ->where('user_id', '!=', $userId)    
            ->whereNotIn('id', $submittedJobIds)     
            ->where('worker_remaining', '>', 0);    
 
      
        //  Boost jobs
        
        $boostedJobs = (clone $baseQuery)
            ->where('is_boosted', true)
            ->where('boosted_until', '>', now())
            ->orderBy('boosted_until', 'desc')   
            ->get();
 
  
        //   TOP jobs
    
        $topJobs = (clone $baseQuery)
            ->where('is_top', true)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
     
        //  NORMAL jobs
        $normalJobs = (clone $baseQuery)
            ->where('is_top', false)
            ->where(function ($q) {
                $q->where('is_boosted', false)
                  ->orWhereNull('boosted_until')
                  ->orWhere('boosted_until', '<=', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();
 
        // ── Priority order এ merge ──
        $jobs = $boostedJobs->concat($topJobs)->concat($normalJobs);
 
        $setting = WebsiteSetting::first();
 
        return view('user.dashboard', compact(
            'jobs',
            'boostedJobs',
            'topJobs',
            'normalJobs',
            'setting'
        ));
       
    }
}
