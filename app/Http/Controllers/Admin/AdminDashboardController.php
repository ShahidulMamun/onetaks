<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobPost;
use App\Models\JobSubmit;
use App\Models\UserTransaction;
use App\Models\SiteWallet;
use App\Models\Deposit;
use App\Models\Withdraw;
use Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
  
   public function adminDashboard()
  {
    

  $data = Cache::remember(
    'admin_dashboard_stats',
    now()->addMinutes(5),
    function () {

        $today = now()->startOfDay();
        $thirtyDaysAgo = now()->subDays(30);

        $chargeTypes = [
            'withdraw',
            'withdraw_charge',
            'jobpost_charge',
            'top_job_charge',
            'boost_job_charge'
        ];

        // Transaction Summary
        $transactionSums = UserTransaction::whereIn('type', $chargeTypes)
            ->selectRaw("
                type,
                SUM(amount) as lifetime_sum,
                SUM(CASE WHEN created_at >= ? THEN amount ELSE 0 END) as sum_30d,
                SUM(CASE WHEN created_at >= ? THEN amount ELSE 0 END) as sum_today
            ", [$thirtyDaysAgo, $today])
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        $getSum = function ($type, $period) use ($transactionSums) {
            return (float) ($transactionSums[$type][$period] ?? 0);
        };

        // Deposit Summary
        $depositSums = Deposit::where('status', 'approved')
            ->selectRaw("
                SUM(amount) as lifetime_sum,
                SUM(CASE WHEN created_at >= ? THEN amount ELSE 0 END) as sum_30d,
                SUM(CASE WHEN created_at >= ? THEN amount ELSE 0 END) as sum_today
            ", [$thirtyDaysAgo, $today])
            ->first();

        $data = [

            // Lifetime
            'total_user' => User::count(),
            'total_posted_job' => JobPost::count(),
            'total_submit_job' => JobSubmit::count(),

            'lifetime_deposit' => (float) ($depositSums->lifetime_sum ?? 0),
            'lifetime_withdraw' => $getSum('withdraw', 'lifetime_sum'),

            'withdraw_charge' => $getSum('withdraw_charge', 'lifetime_sum'),
            'jobpost_charge' => $getSum('jobpost_charge', 'lifetime_sum'),
            'top_job_charge' => $getSum('top_job_charge', 'lifetime_sum'),
            'boost_job_charge' => $getSum('boost_job_charge', 'lifetime_sum'),

            // 30 Days
            'deposit_30d' => (float) ($depositSums->sum_30d ?? 0),
            'withdraw_30d' => $getSum('withdraw', 'sum_30d'),

            'withdraw_charge_30d' => $getSum('withdraw_charge', 'sum_30d'),
            'jobpost_charge_30d' => $getSum('jobpost_charge', 'sum_30d'),
            'top_job_charge_30d' => $getSum('top_job_charge', 'sum_30d'),
            'boost_job_charge_30d' => $getSum('boost_job_charge', 'sum_30d'),

            // Today
            'deposit_today' => (float) ($depositSums->sum_today ?? 0),
            'withdraw_today' => $getSum('withdraw', 'sum_today'),

            'withdraw_charge_today' => $getSum('withdraw_charge', 'sum_today'),
            'jobpost_charge_today' => $getSum('jobpost_charge', 'sum_today'),
            'top_job_charge_today' => $getSum('top_job_charge', 'sum_today'),
            'boost_job_charge_today' => $getSum('boost_job_charge', 'sum_today'),
        ];

        // Profit Calculation
        $profitFields = [
            'withdraw_charge',
            'jobpost_charge',
            'top_job_charge',
            'boost_job_charge'
        ];

        foreach ([
            '' => 'profit_lifetime',
            '_30d' => 'profit_30d',
            '_today' => 'profit_today'
        ] as $suffix => $profitKey) {

            $data[$profitKey] = collect($profitFields)
                ->sum(fn($field) => $data[$field . $suffix] ?? 0);
        }

        return $data;
    }
   );

 
     $siteWallet = SiteWallet::first();
     return view('admin.index', compact('data', 'siteWallet'));
}
 
}
