<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDealController extends Controller
{
     // browse deal
	public function browsedeal(){
	    return view('user.browse_deal'); 
	}

	 // deal create

	public function dealcreate(){
	    return view('user.deal_create'); 
	}

	// my deal post
	public function mydealpost(){
	    return view('user.my_deal_post'); 
	}

	// dealorder
	public function dealorder(){
	    return view('user.deal_order'); 
	} 
}
