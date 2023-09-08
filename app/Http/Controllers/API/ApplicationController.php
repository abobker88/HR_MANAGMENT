<?php

namespace App\Http\Controllers\API;

use App\Enum\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;



class ApplicationController extends Controller
{
    
    //create  submitApplication method to handle the form submission from the mobile app 
    //swagger documentation for this method is available at http://localhost:8000/api/documentation

    public function submitApplication(ApplicationRequest $request)
    {

        if($request->has('cv'))
        {
            $cv=$request->file('cv');
            $cv_name=time().$cv->getClientOriginalName();
            $cv->move(public_path('uploads/cv'),$cv_name);
        }
        else {
            $cv_name=null;
        }
        $id=Application::create(
            [
                'name'=>$request->input('name'),
                'DOB'=>$request->input('DOB'),
                'gender'=>$request->input('gender'),
                'nationality'=>$request->input('nationality'),
                'cv'=>$cv_name,
                'application_date'=>date('Y-m-d'),
                'hr_coordintor_status'=>ApplicationStatus::Pending,
                'hr_manager_status'=>ApplicationStatus::Pending,
            ]
            )->id; 
            if($id)
            {
                return response()->json([
                    'success'=>true,
                    'message'=>'Application submitted successfully',
                ],200);
            }
             else {
                return response()->json([
                    'success'=>false,
                    'message'=>'Application not submitted',
                ],500);
             }
    }
}
