<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BreakingNotice;

class BreakingNoticeController extends Controller
{
    // ✅ List page
    public function index()
    {
        $notices = BreakingNotice::latest()->get();
        return view('admin.notice.index', compact('notices'));
    }

    // ✅ Store (Create)
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        BreakingNotice::create([
            'description' => $request->description,
            'status' => $request->status ?? 'active',
        ]);

        return back()->with('success', 'Notice created successfully');
    }

    // ✅ Edit (data fetch for modal/ajax)
    public function edit($id)
    {
        $notice = BreakingNotice::findOrFail($id);
        return response()->json($notice);
    }

    // ✅ Update
    public function update(Request $request)
    {
        // return $request->all();
        $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $notice = BreakingNotice::findOrFail($request->id);

        $notice->update([
    
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Notice updated successfully');
    }

    // ✅ Delete
    public function destroy($id)
    {
        $notice = BreakingNotice::findOrFail($id);
        $notice->delete();

        return back()->with('success', 'Notice deleted successfully');
    }

    // ✅ Status Toggle (AJAX friendly)
    public function toggleStatus($id)
    {
        $notice = BreakingNotice::findOrFail($id);

        $notice->status = $notice->status === 'active' ? 'inactive' : 'active';
        $notice->save();

        return response()->json([
            'status' => $notice->status,
            'message' => 'Status updated'
        ]);
    }

    // ✅ Frontend active notices
    public function active()
    {
        return BreakingNotice::where('status', 'active')
            ->latest()
            ->get();
    }
}
