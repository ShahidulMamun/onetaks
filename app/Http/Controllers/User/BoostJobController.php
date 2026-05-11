<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserNotification;
use App\Models\UserTransaction;


class BoostJobController extends Controller
{
    public function boost(Request $request, $id)
    {
     
        $request->validate([
            'boost_hours' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,12,24',
        ]);
 
        $job = JobPost::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
 
        $setting = WebsiteSetting::first();
        $chargePerHour = $setting->boost_charge_per_hour ?? 1.00;
        $hours         = (int) $request->boost_hours;
        $totalCost     = $chargePerHour * $hours;
 
        $user = Auth::user();
 
        // ── Balance check ──
        if ($user->current_deposit < $totalCost) {
            return back()->with('error', 'অপর্যাপ্ত ব্যালেন্স। Boost করার জন্য $' . number_format($totalCost, 2) . ' দরকার।');
        }
 
        // ── Job already boosted? extend করো ──
        $boostedUntil = $job->isBoostedActive()
            ? $job->boosted_until->addHours($hours)
            : now()->addHours($hours);
 
        DB::transaction(function () use ($user, $job, $totalCost, $boostedUntil) {
            // Deduct from wallet
            $user->decrement('current_deposit', $totalCost);
 
            // Update job boost
            $job->update([
                'is_boosted'    => true,
                'boosted_until' => $boostedUntil,
            ]);
            
            // create transaction 
             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "charge",
            'amount' => $totalCost,
            'description' => "Job post boosting cost",
            'reference_id' => $job->id,
            'status' => 'success',
           ]);

            //create notification 
            $title = "Job boost";
            $message = "$".$totalCost." has been deducted for job boosting";
              UserNotification::create([
                'user_id' => $user->id,
                'title'   =>$title,
                'message' => $message,
                'status'  => 'pending',
            ]);

        });
 
        return back()->with('success', "Job সফলভাবে {$hours} ঘণ্টার জন্য Boost করা হয়েছে! 🚀");
    }
}
