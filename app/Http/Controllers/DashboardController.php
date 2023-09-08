<?php

namespace App\Http\Controllers;

use App\Enum\ApplicationStatus;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        return view('dashboard.index');
    }

    // dashboard for coordinator 
    public function coordinator()
    {
        //get all application count 
        $applicationCount = Application::count();
        // get application accepted count 
        $applicationAcceptedCount = Application::where('hr_coordintor_status', ApplicationStatus::Accept)->count();
        // get application rejected count 
        $applicationRejectedCount = Application::where('hr_coordintor_status', ApplicationStatus::Reject)->count();

            return view('dashboard.coordinator.dashboard', compact('applicationCount', 'applicationAcceptedCount', 'applicationRejectedCount'));
    }
}
