<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;
use App\Models\Deposit;

class UserDepositController extends Controller
{
    // add deposit
	public function create(){
        
        $methods = PaymentMethod::where('status','active')->get();
	    return view('user.deposit.create',compact('methods')); 
	}

    // user submit deposit
    public function store(Request $request)
    {
       //validation
       $request->validate([
        'payment_method_id' => ['required','integer','exists:payment_methods,id'],
        'amount' => ['required','integer','min:1'],
        'transaction_id' => [ 'required','string','max:255',
        'unique:deposits,transaction_id'],
        'sender_number' => ['required','string','regex:/^[0-9]+$/','min:11','max:15']
        ]);

        // 🔥Sanitation
        $payment_method_id = (int) $request->payment_method_id;
        $amount = (int) $request->amount;
        $transaction_id = trim(strip_tags($request->transaction_id));
        $sender_number = preg_replace('/[^0-9]/', '', $request->sender_number);
        
        //auth user check
        $user = Auth::user();
        if(!$user) {
           abort(401, 'Unauthorized');
        }
   
        Deposit::create([
            'user_id' => $user->id,
            'payment_method_id' => $payment_method_id,
            'amount' => $amount,
            'transaction_id' => $transaction_id,
            'sender_number' => $sender_number,
        ]);
   
        return back()->with('success', 'Deposit request sent successfully!');

    }

	// deposit history
	public function depositHistory(){
         $deposits = Deposit::where('user_id',Auth::user()->id)->with(['method','user'])->get();
         $count = count($deposits);
	    return view('user.deposit.history',compact('deposits','count')); 
	}
}
