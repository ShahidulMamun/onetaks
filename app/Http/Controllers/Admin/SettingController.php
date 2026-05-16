<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
    	$setting = WebsiteSetting::first();
       return view('admin.setting.index',compact('setting'));
    }

     public function update(Request $request)
     {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'site_name' => 'nullable|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:50',
            'min_withdraw' => 'nullable|numeric',
            'min_deposit' => 'nullable|numeric',
            'withdraw_charge' => 'nullable|numeric',
            'jobpost_charge' => 'nullable|numeric',
            'deposit_bonus' => 'nullable|numeric',
            'maintenance_mode' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'dolar_rate'    =>'required|numeric',
            'topjob_charge' =>'required',
            'boost_charge_per_hour'=>'required',
        ]);

         $setting = WebsiteSetting::first();
                // ── site_logo upload ──────────────────────────────
            if ($request->hasFile('site_logo')) {
                // পুরনো file delete
                if ($setting->site_logo && Storage::disk('public')->exists($setting->site_logo)) {
                    Storage::disk('public')->delete($setting->site_logo);
                }
                // নতুন file save — storage/app/public/settings/
                $setting->site_logo = $request->file('site_logo')
                    ->store('settings', 'public');
            }

            // ── favicon upload ────────────────────────────────
            if ($request->hasFile('favicon')) {
                if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                    Storage::disk('public')->delete($setting->favicon);
                }
                $setting->favicon = $request->file('favicon')
                    ->store('settings', 'public');
            }

            // ── বাকি সব fields ───────────────────────────────
            $setting->fill([
                'site_name'             => $request->site_name,
                'site_title'            => $request->site_title,
                'site_description'      => $request->site_description,
                'email'                 => $request->email,
                'phone'                 => $request->phone,
                'address'               => $request->address,
                'facebook'              => $request->facebook,
                'youtube'               => $request->youtube,
                'whatsapp'              => $request->whatsapp,
                'telegram'              => $request->telegram,
                'min_withdraw'          => $request->min_withdraw,
                'min_deposit'           => $request->min_deposit,
                'withdraw_charge'       => $request->withdraw_charge,
                'jobpost_charge'        => $request->jobpost_charge,
                'dolar_rate'            => $request->dolar_rate,
                'topjob_charge'         => $request->topjob_charge,
                'boost_charge_per_hour' => $request->boost_charge_per_hour,
                'deposit_bonus'         => $request->deposit_bonus,
                'maintenance_mode'      => $request->boolean('maintenance_mode'),
                'meta_title'            => $request->meta_title,
                'meta_description'      => $request->meta_description,
                'meta_keywords'         => $request->meta_keywords,
                'boost_charge_per_hour' =>$request->boost_charge_per_hour,
            ]);

          $setting->save();


        return back()->with('message', 'Settings updated successfully');
    }
}
