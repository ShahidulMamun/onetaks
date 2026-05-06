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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // ✅ Sanitize
        $data = collect($data)->map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        })->toArray();

        // ✅ File Upload
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')
                ->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')
                ->store('settings', 'public');
        }

        // checkbox fix
        $data['maintenance_mode'] = $request->has('maintenance_mode');

        $setting = WebsiteSetting::firstOrCreate();
        $setting->update($data);

        return back()->with('message', 'Settings updated successfully');
    }
}
