<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){ 

        $categories = Category::where('is_active',true)->orderBy('name','asc')->get();
    	return view('admin.category.index',compact('categories'));
    }

     public function store(Request $request)
    {
   
    $request->validate([
        'category' => 'required',
        'icon' => 'required',
    ]);

    Category::create([
        'name' => $request->category,
        'icon_emoji' => $request->icon,
        'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category))),
    ]);

    return back()->with('success', 'Category added successfully');
   }


   public function delete($id)
    {

      $category = Category::findOrFail($id);

      if ($category->jobs()->exists()) {
        return back()->with('error','This category Cannot delete because jobs exist under it');
      }
         $category->delete();
 
        return back()->with('success', 'Category deleted successfully');
    }
}
