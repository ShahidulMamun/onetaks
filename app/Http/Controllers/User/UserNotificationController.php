<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserNotification;
use Auth;

class UserNotificationController extends Controller
{
    public function unSeenNotification(){
      $pageTitle="Pending Notification";
      $notifications = UserNotification::where('user_id',Auth::user()->id)->where('status','pending')->orderBy('created_at','desc')->get();
      return view('user.notifications.index',compact(['notifications','pageTitle']));
    }


    public function SeenNotification(){
      $pageTitle="Read Notification";
      $notifications = UserNotification::where('user_id',Auth::user()->id)->where('status','read')->orderBy('created_at','desc')->get();
      return view('user.notifications.index',compact(['notifications','pageTitle']));
    }

    public function markAsRead($id)
   {
    $notification = UserNotification::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$notification) {
        return response()->json([
            'success' => false
        ]);
    }

    $notification->update([
        'status' => 'read'
    ]);

    return response()->json([
        'success' => true
    ]);
   }
}
