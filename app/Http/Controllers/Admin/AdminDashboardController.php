<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboard(){
      
    	return view('admin.index');
    }
}
