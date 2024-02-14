<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\Roles;
use App\Models\RequestStatus;
use App\Models\RequestsType;
use App\Models\Employee;
use App\Models\Assigned;
use App\Models\RequestsVacation;
use Jenssegers\Date\Date;

use Illuminate\Support\Facades\Auth;



class RequestsController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getRequests()
    {        
        Date::setLocale('es');

        $Role = Auth::User()->role_id;
        $Id = Auth::User()->id;
        
        $RequestTypes = RequestsType::where('active',1)->get();  
        $RequestStatus = RequestStatus::where('active',1)->get();    

        if ($Role == 1) {
            $Employee = Employee::where('active',1)->get();               
            $RequestsVacation = RequestsVacation::where('active',1)->get();
        } elseif($Role == 2) {
            $UsersAssigned = Assigned::where('users_id',$Id)->pluck('employee_id')->toArray(); 
            $Employee = Employee::whereIn('id_employee',$UsersAssigned)->get();  
            $RequestsVacation = RequestsVacation::whereIn('employee_id',$UsersAssigned)->get();
        }
        

       
        
        return view('Request.Home',compact('RequestTypes','RequestStatus','Employee','RequestsVacation'));
    }
    public function SaveTypeRequest(Request $request)
    {        
        $response = RequestsVacation::SaveTypeRequest($request);
        return response()->json($response);
    }
    public function rmRequests(Request $request)
    {        
        $response = RequestsVacation::rmRequests($request);
        return response()->json($response);
    }
    public function UpdateRequest(Request $request)
    {        
        $response = RequestsVacation::UpdateRequest($request);
        return response()->json($response);
    }
    public function SaveRequest(Request $request)
    {        
        $response = RequestsVacation::SaveRequest($request);
        return response()->json($response);
    }
    
    
}  