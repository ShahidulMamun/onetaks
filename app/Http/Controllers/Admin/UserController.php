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

    }
}
