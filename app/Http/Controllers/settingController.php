<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\activity_log;
use App\Models\settings;

class settingController extends Controller
{
    //

    public function index()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('open setting page');

        $setting = settings::find(1);


        return view('setting.index',['setting'=>$setting]);
    }

    public function edit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'email',
            'description' => 'string|nullable',
            'facebook' => 'url|nullable',
            'twitter' => 'url|nullable',
            'linkedin' => 'url|nullable',
            'youtube' => 'url|nullable',
            'whatsapp' => 'numeric|nullable',
        ]);

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('open general setting page');

        $setting = settings::find(1);
        $setting->description = $validated['description'];
        $setting->facebook = $validated['facebook'];
        $setting->twitter = $validated['twitter'];
        $setting->linkedin = $validated['linkedin'];
        $setting->youtube = $validated['youtube'];
        $setting->whatsapp = $validated['whatsapp'];
        $setting->email = $validated['email'];


        $setting->save();

        return redirect(route('setting.index'))->with('success','finish edit general setting');
    }
}
