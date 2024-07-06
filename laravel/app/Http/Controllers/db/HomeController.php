<?php

namespace App\Http\Controllers\db;

use App\Http\Controllers\Controller;
use App\Models\SaveLog;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index(Request $request)
{
 // Retrieve the 'length' parameter from the request, defaulting to 10 if not provided
 $length = $request->input('length', 10);
    
 // Query to retrieve SaveLog records ordered by id in descending order and paginated
 $SaveLog = SaveLog::orderBy('id', 'desc')->paginate($length);

 // Return the view with the paginated SaveLog data
     return view('db.home.index', compact('SaveLog'));
}

public function settings(Request $request)
{
     // Retrieve the 'length' parameter from the request, defaulting to 10 if not provided
 $length = $request->input('length', 10);
    
 // Query to retrieve SaveLog records ordered by id in descending order and paginated
 $Settings = Setting::orderBy('id', 'desc')->paginate($length);

 // Return the view with the paginated SaveLog data
     return view('db.home.settings', compact('Settings'));
}

public function create()
{
 return view('db.home.settings_create');
}

public function store(Request $request)
{
    // Validation rules
    $rules = [
        'key' => 'required|unique:settings,key',
        'value' => 'required',
    ];

    // Custom error messages
    $messages = [
        'key.required' => 'The key field is required.',
        'key.unique' => 'The key has already been taken.',
        'value.required' => 'The value field is required.',
    ];

    // Validate the request
    $validatedData = $request->validate($rules, $messages);

    // If validation passes, create the setting
    $setting = Setting::create([
        'key' => $validatedData['key'],
        'value' => $validatedData['value'],
    ]);

    // Optionally, you can return a response or redirect somewhere
    return redirect()->back()->withInput()->with('success', 'تم اضافة الاعدادات بنجاح');
}

public function update(Request $request, $id)
{
 
    // Find the setting by ID
    $setting = Setting::findOrFail($id);

    // Update the setting
    $setting->key = $request->key;
    $setting->value = $request->value;
    $setting->save();

    // Optionally, you can return a response or redirect somewhere
    return redirect()->back()->withInput()->with('success', 'تم تحديث الاعدادات بنجاح');
}

public function destroy($id)
{
    // Find the setting by ID
    $setting = Setting::findOrFail($id);

    // Delete the setting
    $setting->delete();

    // Optionally, you can return a response or redirect somewhere
    return redirect()->back()->with('success', 'تم حذف الاعدادات بنجاح');
}

}
