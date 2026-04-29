<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

    	 $users = User::orderBy('id','desc')->paginate(10);
    	return view('admin.user.index',compact('users'));
    }


    public function userActiveInactive(Request $request){
    
    $validated = $request->validate([
        'id' => ['required', 'integer', 'exists:users,id'],
        'status'  => ['required', 'in:0,1'],
    ]);

     $user = User::findorfail($request->id);
     $user->status=$request->status;
     $user->save();
     return back()->with('message', 'User Status Updated');

    }
}
