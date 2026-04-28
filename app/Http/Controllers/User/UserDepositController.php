<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDepositController extends Controller
{
    // add deposit
public function create(){
    return view('user.deposit'); 
    }

// deposithistory
public function depositHistory(){
    return view('user.deposit_history'); 
    }
}
