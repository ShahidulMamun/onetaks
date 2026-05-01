<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;

class DepositController extends Controller
{
    public function pendingDeposit(){
     $pageTitle="Pending Deposit";	
     $deposits = Deposit::where('status','pending')->orderBy('created_at')->get();
     return view('admin.deposits.index',compact(['deposits','pageTitle']));
    }

    public function approvedDeposit(){
     $pageTitle="Approved Deposit";	
     $deposits = Deposit::where('status','approved')->orderBy('created_at')->get();
     return view('admin.deposits.index',compact(['deposits','pageTitle']));
    }

    public function rejectedDeposit(){
     $pageTitle="Rejected Deposit";	
     $deposits = Deposit::where('status','rejected')->orderBy('created_at')->get();
     return view('admin.deposits.index',compact(['deposits','pageTitle']));
    }
}
