<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
   {
    $query = User::orderBy('id', 'desc')
                 ->with('postedJobs', 'submittedJobs');
 
    // Search by ID
    if ($request->filled('search_id')) {
        $query->where('id', $request->search_id);
    }
 
    // Search by username
    if ($request->filled('search_username')) {
        $query->where('name', 'like', '%' . $request->search_username . '%');
    }
 
    // Search by email
    if ($request->filled('search_email')) {
        $query->where('email', 'like', '%' . $request->search_email . '%');
    }
 
    // Filter by status
    if ($request->filled('search_status')) {
        $query->where('status', $request->search_status);
    }
 
    $users = $query->paginate(5);
 
    return view('admin.user.index', compact('users'));
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

    public function delete($id){

    	 $user = User::findOrFail($id);
        //delete logo
	     if ($user->logo && Storage::disk('public')->exists($user->logo)) {
	     Storage::disk('public')->delete($user->logo);
	     }
         $user->delete();

         return back()->with('message', 'User deleted successfully');
    }

    public function userDetails($id)
   {
    $user = User::findOrFail($id);

    return view('admin.user.user-info', compact('user'));
  }
}
