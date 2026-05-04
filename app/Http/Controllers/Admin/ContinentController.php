<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Models\Continent;

class ContinentController extends Controller
{
    public function index(){
    	$continents = Continent::where('is_active',true)->orderBy('name','asc')->get();
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
}
