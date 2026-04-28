<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
   
// about Us
public function aboutUs(){
        return view('about_us');
    }

// policy pages
public function policy(){
   return view('privacy_policy');
 }

// terms
public function terms(){
   return view('terms_conditions');

   }

// marketplace

   public function marketplace(){
      return view('microjob_marketplace');
   }


// dealMarketplace

    public function dealMarketplace(){
      return view('deal_marketplace');
   }


}
