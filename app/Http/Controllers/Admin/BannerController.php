<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index(Request $request){
      $query = Banner::with('user')->latest();
 
        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%$s%")
                  ->orWhere('code',  'like', "%$s%")
                  ->orWhereHas('user', fn($u) => $u->where('name','like',"%$s%")
                                                    ->orWhere('email','like',"%$s%"));
            });
        }
 
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
 
        // Position filter
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }
 
        // Sort
        match ($request->get('sort','latest')) {
            'oldest'  => $query->oldest(),
            'clicks'  => $query->orderByDesc('clicks'),
            'price'   => $query->orderByDesc('price'),
            default   => $query->latest(),
        };
 
        $banners = $query->paginate(15);
 
        // Mini counts for stats row
        $counts = [
            'all'      => Banner::count(),
            'pending'  => Banner::where('status','pending')->count(),
            'active'   => Banner::where('status','active')->count(),
            'inactive' => Banner::where('status','inactive')->count(),
            'expired'  => Banner::where('status','expired')->count(),
            'rejected' => Banner::where('status','rejected')->count(),
        ];
 
        return view('admin.banner.index', compact('banners','counts'));
    
    }


    public function approve($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'status'      => 'active',
            'approved_at' => now(),
            'expired_at'  => now()->addDays($banner->days),
        ]);
 
        return back()->with('success', 'Banner approved and set to active.');
    }

    public function inactive($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['status' => 'inactive']);
 
        return back()->with('success', 'Banner has been deactivated.');
    }
    

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
 
        // Delete thumbnail from storage if exists
        if ($banner->thumbnail && \Storage::disk('public')->exists($banner->thumbnail)) {
            \Storage::disk('public')->delete($banner->thumbnail);
        }
 
        $banner->delete();
 
        return back()->with('success', 'Banner deleted permanently.');
    }

    public function reject(Request $request)
    {
        $request->validate([
            'id'              => 'required|exists:banners,id',
            'rejected_reason' => 'required|string|max:500',
        ]);
 
        Banner::findOrFail($request->id)->update([
            'status'          => 'rejected',
            'rejected_reason' => $request->rejected_reason,
        ]);
 
        return back()->with('success', 'Banner rejected.');
    }
}
