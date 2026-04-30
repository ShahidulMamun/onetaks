<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class UserDepositController extends Controller
{
    // add deposit
	public function create(){
        
        $methods = PaymentMethod::where('status','active')->get();
	    return view('user.deposit.index',compact('methods')); 
	}

    // user submit deposit
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required',
            'amount' => 'required|numeric|min:10',
            'transaction_id' => 'required|unique:deposits',
            'sender_number' => 'nullable',
        ]);

        Deposit::create([
            'user_id' => auth()->id(),
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'sender_number' => $request->sender_number,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Deposit request sent successfully!');
    }

	// deposithistory
	public function depositHistory(){
	    return view('user.deposit.history'); 
	}
}
