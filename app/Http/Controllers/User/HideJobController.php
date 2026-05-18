<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\HideJob;

class HideJobController extends Controller
{
   public function hideJob(Request $request, $jobId)
{
    $already = HideJob::where('user_id', Auth::id())
                      ->where('job_id', $jobId)
                      ->exists();

    if ($already) {
        
        $message = "আপনি এই Job টি আগেই hide করেছেন।";
        return redirect()->route('user.find.jobs')->with('error',$message);
       
    }

    HideJob::create([
        'user_id' => Auth::id(),
        'job_id'  => $jobId,
    ]);

   return redirect()->route('user.find.jobs')
   ->with('success','Job hide successfully');
}
}
