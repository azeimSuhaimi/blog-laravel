<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\activity_log;

class dashboardController extends Controller
{
    //

    public function index()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view dashboard');
        
        return view('dashboard.index');
    }
}
