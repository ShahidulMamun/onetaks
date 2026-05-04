<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Models\Continent;
use App\Models\Country;
class CountryController extends Controller
{
    public function index(){
    	$continents = Continent::where('is_active',true)->orderBy('name','asc')->get();
    	$countries = Country::where('is_active',true)->orderBy('name','asc')->get();
    	return view('admin.country.index',compact(['countries','continents']));
    }

    public function store(Request $request)
    {

   
    $request->validate([
        'name' => 'required',
        'code' => 'required|unique:countries,code',
        'continent_id' => 'required|exists:continents,id',
    ]);

    Country::create([
        'name' => $request->name,
        'code' => $request->code,
        'phone_code' => $request->phone_code,
        'continent_id' => $request->continent_id,
    ]);

    return back()->with('success', 'Country added successfully');
   }

    public function delete($id)
    {

      $country = Country::findOrFail($id);

      if ($country->jobPosts()->exists()) {
        return back()->with('error','This country Cannot delete because jobs exist under it');
      }
         $country->delete();
 
        return back()->with('success', 'Country deleted successfully');
    }


}
