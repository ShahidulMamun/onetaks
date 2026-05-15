<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BannerAdsPrice;
use App\Models\Banner;
use App\Models\UserTransaction;
use App\Models\UserNotification;
use Auth;
class UserBannerController extends Controller
{
    public function store(Request $request)
   {
    $request->validate([
        'title' => ['required','string','max:255'],
        'thumbnail' => ['required','image','mimes:jpg,jpeg,png,webp','max:2048'],
        'link' => ['required','url'],
        // 'position' => ['required','string'],
        'days' => ['required','integer','min:1','max:30'],
    ]);

    // get package price
    $package = BannerAdsPrice::where('days',$request->days)->first();

    if(!$package){
        return back()->with('error','Invalid banner package');
    }
    $user = Auth::user();
    if ($package->price>$user->current_deposit) {
    	 return back()->with('error','You have not enough deposit');
    }

    // upload thumbnail
    $thumbnail = null;

    if($request->hasFile('thumbnail')){
        $thumbnail = $request->file('thumbnail')
            ->store('banners','public');
    }
       
     
    // create banner
    $banner = Banner::create([
        'user_id' => $user->id,
        'code' => strtoupper(Str::random(10)),
        'title' => strip_tags($request->title),
        'thumbnail' => $thumbnail,
        'link' => $request->link,
        'days' => $request->days,
        'price' => $package->price,
        'status' => 'pending',
    ]);

     $user->decrement('current_deposit',$package->price);

       //user notification
            $title = "Banner Ads posted";
            $message = "$".$package->price." has been deducted for banner ads";
            UserNotification::create([
                'user_id' => $user->id,
                'title'   =>$title,
                'message' => $message,
                'status'  => 'pending',
            ]);


             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "charge",
            'amount' => $package->price,
            'description' => "Banner ads cost deducted",
            'reference_id' => $banner->id,
            'status' => 'success',
           ]);



    return back()->with(
        'success',
        'Banner ads created successfully and waiting for approval'
    );
   }

   public function bannerClick($id)
   {
    $banner = Banner::findOrFail($id);
    // increment click
    $banner->increment('clicks');
    // redirect to original link
    return redirect()->away($banner->link);
   }
}