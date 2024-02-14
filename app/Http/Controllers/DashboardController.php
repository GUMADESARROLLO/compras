<?php
namespace App\Http\Controllers;

use App\Models\Articulos;
use Illuminate\Http\Request;
use App\Models\RequestsVacation;
use App\Models\Department;
use Jenssegers\Date\Date;


class DashboardController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDashboard()
    {      
        Date::setLocale('es');  

        $RequestsVacation = RequestsVacation::where('active',1)->get();
        $Department = Department::where('active',1)->get();
        return view('Dashboard.Home', compact('RequestsVacation','Department'));
    }
    
}  