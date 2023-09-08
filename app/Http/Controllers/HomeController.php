<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        if (auth()->check()) {
            // check if user is hr coordinator
            if (auth()->user()->getRoleNames()->first() == 'hr_coordinator') {
                return redirect()->route('dashboard.coordinator');
            }
            // check if user is hr manager
            if (auth()->user()->getRoleNames()->first() == 'hr_manager') {
                return redirect()->route('application.getApplicationsForManager');
            }
        }

        return view('home.index');
    }
}
