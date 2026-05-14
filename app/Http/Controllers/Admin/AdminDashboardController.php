<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobPost;
use App\Models\JobSubmit;
use App\Models\UserTransaction;
use App\Models\SiteWallet;
use Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboard(){

    	$data = [
        'total_user'        => User::count(),
        'total_posted_job'  => JobPost::count(),
        'total_submit_job'  => JobSubmit::count(),
        'lifetime_profit'   => UserTransaction::where('type', 'profit')->sum('amount'),
        'lifetime_withdraw'  => UserTransaction::where('type', 'withdraw')->sum('amount'),
        'withdraw_charge'   => UserTransaction::where('type', 'withdraw_charge')->sum('amount'),
        'jobpost_charge'    => UserTransaction::where('type', 'jobpost_charge')->sum('amount'),
    ];
        $siteWallet = SiteWallet::first();
    	return view('admin.index',compact('data','siteWallet'));
    }
}
