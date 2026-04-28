<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function index(){
    	$methods = PaymentMethod::all();
    	return view('admin.payment-method.index',compact('methods'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
            'type' => 'required'
        ]);

        $logoName = null;

        if ($request->hasFile('logo')) {
            $logoName = $request->file('logo')->store('method-logo', 'public');
        }

        PaymentMethod::create([
            'name' => $request->name,
            'type' => $request->type,
            'number' => $request->number,
            'logo' => $logoName,
        ]);

        return back()->with('success', 'Payment Method Added');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    public function update(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
        'id' => 'required',
        'name' => 'required',
        'number' => 'required',
        'type' => 'required',
        'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:1024'
         ]);

       // validation fail
        if ($validator->fails()) {

	        if ($request->ajax()) {
	            return response()->json([
	                'status' => false,
	                'errors' => $validator->errors()
	            ], 422);
	        }
	       return back()->withErrors($validator)->withInput();
	    }
        
        //Sanitization 
		$id = (int) $request->id;
	    $name = trim(strip_tags($request->name));
	    $number = preg_replace('/[^0-9+]/', '', $request->number);
	    $type = trim(strip_tags($request->type));
    

        $method = PaymentMethod::findOrFail($request->id);

        if ($request->hasFile('logo')) {
          
         //delete old image 
         if ($method->logo && Storage::disk('public')->exists($method->logo)) {
	     Storage::disk('public')->delete($method->logo);
	     }
         
         //upload new image
	     $logoName = $request->file('logo')->store('method-logo', 'public');

	     //update database
         $method->logo = $logoName;
        }

        $method->update([
            'name' => $name,
            'type' => $type,
            'number' => $number,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Method updated successfully');
    }

    public function delete($id)
    {

         $method = PaymentMethod::findOrFail($id);

        //delete logo
	     if ($method->logo && Storage::disk('public')->exists($method->logo)) {
	     Storage::disk('public')->delete($method->logo);
	     }

         $method->delete();
 
        return back()->with('message', 'Method deleted successfully');
    }
}
