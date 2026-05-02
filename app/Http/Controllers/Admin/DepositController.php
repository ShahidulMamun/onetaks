<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\UserNotification;

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

	public function rejectDeposit($id)
	{
	    $deposit = Deposit::findOrFail($id);

	    // already processed check
	    if ($deposit->status !== 'pending') {
	        return back()->with('error', 'Already processed');
	    }

	    DB::beginTransaction();

	    try {
	        $deposit->status = 'rejected';
	        $deposit->save();

	        UserNotification::create([
	            'user_id' => $deposit->user_id,
	            'message' => "Your $".$deposit->amount ."deposit has been rejected.",
	            'status'  => 'pending',
	        ]);

	        DB::commit();

	        return back()->with('success', 'Deposit rejected');

	    } catch (\Exception $e) {
	        DB::rollBack();

	        return back()->with('error', 'Something went wrong');
	    }
	}
   
}
