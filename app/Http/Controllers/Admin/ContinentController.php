<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Models\Continent;
use Illuminate\Support\Facades\Validator;

class ContinentController extends Controller
{
    public function index(){
    	$continents = Continent::orderBy('name','asc')->get();
    	return view('admin.continent.index',compact('continents'));
    }

    public function store(Request $request)
   {
    $request->validate([
        'name' => 'required',
        'code' => 'required|unique:continents,code|max:5',
        'emoji' => 'nullable'
    ]);

    Continent::create([
    'name'  => trim(strip_tags($request->name)),
    'code'  => strtoupper(trim($request->code)),
    'emoji' => trim($request->emoji),
    ]);

    return back()->with('success', 'Continent added successfully');
   }


    public function delete($id)
    {

      $continent = Continent::findOrFail($id);

      if ($continent->countries()->whereHas('jobPosts')->exists()) {
        return back()->with('error','This continent Cannot delete because countries exist under it');
      }
         $continent->delete();
 
        return back()->with('success', 'Continent deleted successfully');
    }



      public function update(Request $request)
     {
      // return $request->status;
        $validator = Validator::make($request->all(), [
        'id' => 'required|exists:continents,id',
        'name' => 'required|string|max:255',
        'status' => 'required|in:0,1',
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


        $continent = Continent::findOrFail($request->id);

        $continent->update([
            'name' => $name,
            'is_active' => $request->status,
        ]);

        return back()->with('success', 'Continent updated successfully');
    }
}
