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
    'name' => Purifier::clean(trim($request->name)),
    'code' => strtoupper(Purifier::clean(trim($request->code))),
    'emoji' => Purifier::clean(trim($request->emoji)),
    ]);

    return back()->with('success', 'Continent added successfully');
   }
}
