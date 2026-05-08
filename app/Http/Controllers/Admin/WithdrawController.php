<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\UserNotification;

class WithdrawController extends Controller
{
     public function index(Request $request)
    {
        $query = Withdraw::with('user')->latest();
 
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
 
        // Filter by account type (bkash, nagad, rocket, bank …)
        if ($request->filled('account_type')) {
            $query->where('account_type', $request->account_type);
        }
 
        // Search by user name, email, or account number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('account_no', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) =>
                      $u->where('name',  'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                  );
            });
        }
 
        // If no filter → default to pending only on first load (optional; remove if you want all)
        // Uncomment the line below if you want the page to show only pending by default:
        // if (!$request->hasAny(['status','search','account_type'])) {
        //     $query->where('status', 'pending');
        // }
 
        $withdraw = $query->paginate(20);
 
        return view('admin.withdraw.index', compact('withdraw'));
    }
 
    /**
     * Approve a pending withdrawal.
     */
    public function approve($id)
    {
        $withdraw = Withdraw::findOrFail($id);
 
        if ($withdraw->status !== 'pending') {
            return redirect()->route('admin.withdraw.index')
                             ->with('error', 'Only pending withdrawals can be approved.');
        }
 
        $withdraw->update(['status' => 'approved']);
 
        // Optional: notify the user
        // $withdraw->user->notify(new WithdrawApproved($withdraw));
 
        return redirect()->route('admin.withdraw.index')
                         ->with('success', 'Withdrawal approved successfully.');
    }
 
    /**
     * Reject a pending withdrawal with a reason.
     */
    public function reject(Request $request, $id)
    {
      try {

        $request->validate([
            'reason' => 'required|string|max:200',
        ]);

        $withdraw = Withdraw::findOrFail($id);

        // Only pending withdraw can be rejected
        if ($withdraw->status !== 'pending') {
            return redirect()->route('admin.withdraw.index')
                ->with('error', 'Only pending withdrawals can be rejected.');
        }

        $amount = $withdraw->amount;
        $charge = $withdraw->charge;
        $total_amount = $amount + $charge;

        $user = User::findOrFail($withdraw->user_id);

        // Refund balance
        $user->increment('current_earning', $total_amount);

        // User notification
        $title = "Withdraw rejected";
        $message = "Your $" . $amount . " withdraw request has been rejected and $" . $total_amount . " refunded to your balance.";

        UserNotification::create([
            'user_id' => $user->id,
            'title'   => $title,
            'message' => $message,
            'status'  => 'pending',
        ]);

        // Update withdraw status
        $withdraw->update([
            'status' => 'rejected',
            'reason' => $request->reason,
        ]);

        return redirect()->route('admin.withdraw.index')
            ->with('success', 'Withdrawal rejected successfully.');

      } catch (\Exception $e) {

        return redirect()->back()
            ->with('error',. $e->getMessage());
      }
   }
}
