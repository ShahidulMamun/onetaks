<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserProfileController extends Controller
{
    public function userProfile(){
    	return view('user.profile');
    }

     public function userProfileUpdate(Request $request)
    {
        // name sanitize
        $name = trim(strip_tags($request->name));
        $name = preg_replace('/\s+/', ' ', $name);
        $name = preg_replace('/[^\pL\s\-\.]/u', '', $name);
        
        // Phone normalize
        $phone = $request->phone;
        
        if (!empty($phone)) {
            $phone = preg_replace('/[^0-9+]/', '', $phone);
        
            if (str_starts_with($phone, '+880')) {
                $phone = '0' . substr($phone, 4);
            } elseif (str_starts_with($phone, '880')) {
                $phone = '0' . substr($phone, 3);
            }
        
            $phone = trim($phone);
        }
        
           // merge sanitized data BEFORE validation
        $request->merge([
            'name' => $name,
            'phone' => $phone
        ]);
            
        //data validation
        $validatedData = $request->validate([
            'name'  => ['required', 'string', 'min:3','max:50', 'regex:/^[\pL\s\-\.]+$/u'],
            'phone' => ['nullable', 'regex:/^01[3-9]\d{8}$/']
        ]);
 
        
        $user = Auth::user();

        $user->name = $name;
        $user->phone = $phone;
        $user->save();
        return redirect()->back()->with('message','Data updated successfully!');
    }

    public function userPhotoUpdate(Request $request)
    {
       
       
        $validatedData = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        
        $user = Auth::user();

	    if ($request->hasFile('image')) {
	    //  old image delete
	    if ($user->photo && Storage::disk('public')->exists($user->photo)) {
	        Storage::disk('public')->delete($user->photo);
	    }
	    // image upload
	    $imagePath = $request->file('image')->store('users', 'public');
	    // save path
	    $user->photo = $imagePath;
	   }
    
        $user->save();
    
        return redirect()->back()->with('message','Photo updated successfully!');
    }


	public function userPasswordUpdate(Request $request)
	{
	    $request->validate([
	        'current_password' => ['required'],
	        'password' => ['required', 'min:6', 'confirmed'],
	    ]);

	    $user = Auth::user();

	    //  current password check
	    if (!Hash::check($request->current_password, $user->password)) {
	        return back()->withErrors([
	            'current_password' => 'Current password is incorrect'
	        ]);
	    }

	    //  update new password
	    $user->password = Hash::make($request->password);
	    $user->save();

	    return back()->with('message', 'Password updated successfully!');
	}

}
