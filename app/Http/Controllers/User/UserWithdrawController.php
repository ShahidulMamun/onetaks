<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Withdraw;

class UserWithdrawController extends Controller
{
    public function index(){

    	$methods = PaymentMethod::where('status','active')->get();
    	return view('user.withdraw.create',compact('methods'));
    }
}
