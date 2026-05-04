<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
     public function index(){ 

        $categories = Category::where('is_active',true)->orderBy('name','asc')->get();
        $subcategories = SubCategory::where('is_active',true)->orderBy('name','asc')->get();
    	return view('admin.subcategory.index',compact(['categories','subcategories']));
    }

     public function store(Request $request)
    {
    
    $request->validate([
        'category_id' => 'required',
        'subcategory' => 'required',
        'minimum_cost'       => 'required',
    ]);

     SubCategory::create([
        'category_id' => $request->category_id,
        'name' => $request->subcategory,
        'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->subcategory))),
        'minimum_cost'=>$request->minimum_cost,
    ]);

    return back()->with('success', 'SubCategory added successfully');
   }
}
