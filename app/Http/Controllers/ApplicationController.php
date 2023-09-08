<?php

namespace App\Http\Controllers;

use App\Enum\ApplicationStatus;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DataTables;
class ApplicationController extends Controller
{
    
    // method to render application in datatable  for coordinators 
    public function getApplicationsForCoordinator(Request $request)
    {
        if($request->ajax())
        {
            $data = Application::where('hr_coordintor_status',ApplicationStatus::Pending)->orWhere('hr_coordintor_status',ApplicationStatus::Reject)->select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            //download cv add column to datatable 
            ->addColumn('cv', function($row){
                $btn = '<a href="'.asset('uploads/cv/'.$row->cv).'" target="_blank" class="btn btn-primary btn-sm">'.$row->cv.'</a>';
                return $btn;
            })
            ->addColumn('action', function($row){
                if($row->hr_coordintor_status==ApplicationStatus::Pending){
                    $btn   = '<div class="btn-group">';
                    $btn .= '<div class="ps-1" style="display:inline-block;width:100px">';
                    $btn .= '<a href="javascript:void(0)" data-status='.ApplicationStatus::Accept.' data-application_id='.$row->id.' class=" btn btn-success accept btn-sm">Accept</a>';
                    $btn.= '</div>';
                    $btn .= '<div class="ps-1" style="display:inline-block;width:100px">';
                    $btn .= '<a href="javascript:void(0)" data-status='.ApplicationStatus::Reject.' data-application_id='.$row->id.' class="btn btn-danger reject btn-sm">Reject</a>';
                    $btn .= '</div>';
                    $btn .= '</div>';
            } else {
                $btn='<span class="badge bg-success">Rejected</span>';
            }
                    return $btn;
            })
            ->rawColumns(['action','cv'])
            ->make(true);
       }

      return view('dashboard.coordinator.applications');
        }
        // method to render application in datatable  for managers
        public function getApplicationsForManager(Request $request)
        {
            if($request->ajax())
            {
                $data = Application::where('hr_coordintor_status',ApplicationStatus::Accept)->where('hr_manager_status',ApplicationStatus::Pending)->select('*');
                return Datatables::of($data)
                ->addIndexColumn()
                //download cv add column to datatable 
                ->addColumn('cv', function($row){
                    $btn = '<a href="'.asset('uploads/cv/'.$row->cv).'" target="_blank" class="btn btn-primary btn-sm">'.$row->cv.'</a>';
                    return $btn;
                })
                ->addColumn('action', function($row){
                    if($row->hr_manager_status==ApplicationStatus::Pending){
                        $btn   = '<div class="btn-group">';
                        $btn .= '<div class="ps-1" style="display:inline-block;width:100px">';
                        $btn .= '<a href="javascript:void(0)" data-status='.ApplicationStatus::Accept.' data-application_id='.$row->id.' class=" btn btn-success accept btn-sm">Accept</a>';
                        $btn.= '</div>';
                        $btn .= '<div class="ps-1" style="display:inline-block;width:100px">';
                        $btn .= '<a href="javascript:void(0)" data-status='.ApplicationStatus::Reject.' data-application_id='.$row->id.' class="btn btn-danger reject btn-sm">Reject</a>';
                        $btn .= '</div>';
                        $btn .= '</div>';
                } else {
                    $btn='<span class="badge bg-success">Rejected</span>';
                }
                        return $btn;
                })
                ->rawColumns(['action','cv'])
                ->make(true);
           }
    
          return view('dashboard.manager.applications');
            }


        // method to render application in datatable  for coordinators 
    public function getReportApplicationsForCoordinator(Request $request)
    {
        if($request->ajax())
        {
            $data = Application::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            //download cv add column to datatable 
            ->addColumn('cv', function($row){
                $btn = '<a href="'.asset('uploads/cv/'.$row->cv).'" target="_blank" class="btn btn-primary btn-sm">'.$row->cv.'</a>';
                return $btn;
            })
            ->addColumn('hr_coordinator_status', function($row){
                if($row->hr_coordintor_status==ApplicationStatus::Pending){
                    $btn='<span class="badge bg-warning">Pending</span>';
                } else if($row->hr_coordintor_status==ApplicationStatus::Accept){ 
                    $btn='<span class="badge bg-success">Accepted</span>';
                } else {
                    $btn='<span class="badge bg-danger">Rejected</span>';
                }
                return $btn;
            })
            ->addColumn('hr_manager_status', function($row){
                if($row->hr_manager_status==ApplicationStatus::Pending || $row->hr_manager_status==null){
                    $btn='<span class="badge bg-warning">Pending</span>';
                } else if($row->hr_manager_status==ApplicationStatus::Accept){ 
                    $btn='<span class="badge bg-success">Accepted</span>';
                } else {
                    $btn='<span class="badge bg-danger">Rejected</span>';
                }
                return $btn;
            })
            ->rawColumns(['hr_coordinator_status','hr_manager_status','cv'])
            ->make(true);
       }

      return view('dashboard.coordinator.report');
        }

    // method to render application in datatable  for managers

       


  // create submitApplication method to handle the form submission from the web app
  public function submitApplication(Request $request)
  {
    $validator = Validator::make($request->all(),[
             'name'=>           'required',
             'DOB'             =>'required',
             'gender'          =>'required|in:male,female',
             'nationality'     =>'required',
             'cv'              =>'required|mimes:pdf|max:10000',
    ]);

    if ($validator->fails()) {
        Session::flash('error', $validator->messages()->first());
        return redirect()->back()->withInput($request->input());
   }
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
            // return to view with sucess message 
            return redirect()->back()->with('success','Application submitted successfully');
          }
           else {
            // return to view with error message
            return redirect()->back()->with('error','Application not submitted');
           }
  }




    // create method that accepts or reject a application request object
    public function acceptOrRejectApplicationByCoordintor(Request $request)
    {
        //validate the request
        $this->validate($request,[
            'application_id'=>'required|integer',
            'status'=>'required|in:accepted,rejected',
        ]);
        $application_id=$request->input('application_id');
        $status=$request->input('status');
        $application=Application::find($application_id);
        if($application)
        {
            $application->hr_coordintor_status=$status;
           // by coordinator id save to application table
            $application->coorditor_id=auth()->user()->id;            
            $application->save();
            return response()->json([
                'success'=>true,
                'message'=>'Application status updated successfully',
            ],200);
        }
        else {
            return response()->json([
                'success'=>false,
                'message'=>'Application not found',
            ],404);
        }
    }


    // create method that accepts or reject a application request object by manager 
    public function acceptOrRejectApplicationByManager(Request $request)
    {
        //validate the request
        $this->validate($request,[
            'application_id'=>'required|integer',
            'status'=>'required|in:accepted,rejected',
        ]);
        $application_id=$request->input('application_id');
        $status=$request->input('status');
        $application=Application::find($application_id);
        if($application)
        {
            $application->hr_manager_status=$status;
            // by manager id save to application table
            $application->manager_id=auth()->user()->id;            
            $application->save();
            return response()->json([
                'success'=>true,
                'message'=>'Application status updated successfully',
            ],200);
        }
        else {
            return response()->json([
                'success'=>false,
                'message'=>'Application not found',
            ],404);
        }
    }
    
}
