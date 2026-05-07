<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Withdraw;
use App\Models\WebsiteSetting;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserWithdrawController extends Controller
{
    public function index(){

    	$setting = WebsiteSetting::first();

    	$methods = PaymentMethod::where('status','active')->get();
    	return view('user.withdraw.create',compact('methods','setting'));
    }

    // public function create(Request $request){
    //    $setting = WebsiteSetting::first();

    //    $minWithdraw = $setting->min_withdraw;
      
    //    $request->validate([
    //   'method' => 'required',
    //   'number' => 'required',
    //   'withdraw_amount' => 'required|numeric|min:'.$minWithdraw,
    //   ]);


    //    $amount = $request->withdraw_amount;
    //    $chargeParcentage = $setting->withdraw_charge;
    //    $charge = ($amount*$chargeParcentage)/100;

    //    $withdraw_with_charge = $amount+$charge;
       
    //    $user = Auth::user();

    //   if ($withdraw_with_charge>$user->current_earning) {
       
    //    $message =  "You have need $".$withdraw_with_charge ." for withdraw with $". $charge ." charge";
    //    return back()->with('error',$message);
    //   }
      
    //    Withdraw::create([
    //     'user_id'       => $user->id,
    //     'account_type'  => $request->method,
    //     'account_no'    => $request->number,
    //     'amount'        => $amount,
    //     'charge'        => $charge,
    //     'status'        => 'pending',
    //   ]);

    //    $user->decrement('current_earning',$withdraw_with_charge)


    //    $message = "Your ". $amount ." withdraw submitted and pending";
    //        UserNotification::create([
    //             'user_id' => $user->user_id,
    //             'message' => $message,
    //             'status'  => 'pending',
    //      ]);
      

    // }

    public function create(Request $request)
{
    try {

        $setting = WebsiteSetting::first();

        $minWithdraw = $setting->min_withdraw;

        // validation
        $request->validate([
            'method' => 'required',
            'number' => 'required',
            'withdraw_amount' => 'required|numeric|min:' . $minWithdraw,
        ]);

        $user = Auth::user();

        $amount = $request->withdraw_amount;

        // charge calculation
        $chargePercentage = $setting->withdraw_charge;
        $charge = ($amount * $chargePercentage) / 100;

        $withdraw_with_charge = $amount + $charge;

        // balance check
        if ($withdraw_with_charge > $user->current_earning) {

            return back()->with('error',
                "You need $" . number_format($withdraw_with_charge, 2) .
                " for withdraw (including $" . number_format($charge, 2) . " charge)"
            );
        }

        DB::beginTransaction();

        // create withdraw
        Withdraw::create([
            'user_id'       => $user->id,
            'account_type'  => $request->method,
            'account_no'    => $request->number,
            'amount'        => $amount,
            'charge'        => $charge,
            // 'final_amount'  => $amount, // optional (use if needed)
            'status'        => 'pending',
        ]);

        // balance deduct (FIXED missing semicolon + safe update)
        $user->decrement('current_earning', $withdraw_with_charge);

        // notification
        $message = "Your $" . $amount . " withdraw request submitted and pending";

        UserNotification::create([
            'user_id' => $user->id,
            'message'  => $message,
            'status'   => 'pending',
        ]);

        DB::commit();

        return back()->with('success', $message);

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}
}
