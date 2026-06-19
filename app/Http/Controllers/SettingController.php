<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'required',
            'school_address' => 'nullable',
            'school_phone' => 'nullable',
            'school_email' => 'nullable|email',
        ]);

        $setting = Setting::first();
        $setting->update($request->all());

        return redirect()->route('settings.index')->with('success', 'School settings updated successfully!');
    }
}