<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function pendingBanner(){
      $banners = Banner::where('status','pending')->get();
      return view('admin.banner.index',compact('banners'));
    }

    public function approveBanner($id){
     
     $banner = Banner::findorfail($id);
     $banner->status='approved';
     $banner->approved_at= now();
     $banner->save();

     return back()->with('success','banner approved successfully');


     
    }
}
