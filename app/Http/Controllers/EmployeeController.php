<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kardex;
use App\Models\Contract;
use App\Models\Position;
use App\Models\Catalogos;
use App\Models\Employee;
use App\Models\PayrollType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getHome()
    {        
        return view('Employee.Form');
    }

    public function Employee()
    {        
        $Employee = Employee::where('active',1)->get();
        return view('Employee.Home',Compact('Employee'));
    }

    public function AddEmployee()
    {
        $Contract = Contract::where('active',1)->get();  
        $Position = Position::where('active',1)->get();
        $Paises =   Catalogos::Nacionalidades();   
        $PayrollTypes = PayrollType::where('active',1)->get();
        return view('Employee.Form', compact('Contract','Position','Paises','PayrollTypes'));
    }

    public function SaveEmployee(Request $request)
    {
        Employee::SaveEmployee($request);
        return redirect()->route('AddEmployee')->with('message_success', 'Registro creado exitosamente :)');

    }
    public function UpdateEmployee(Request $request)
    {
        $id_employee        = $request->input('id_employee');

        Employee::UpdateEmployee($request);
        return redirect()->route('EditEmployee', ['id_employee' => $id_employee])->with('message_success', 'Registro Actualizado exitosamente :)');

    }
    
    
    public function rmEmployee(Request $request)
    {        
        $response = Employee::rmEmployee($request);
        return response()->json($response);
    }

    public function EditEmployee($id)
    {
        $Contract = Contract::where('active',1)->get();  
        $Position = Position::where('active',1)->get();
        $Paises =   Catalogos::Nacionalidades();

        $Employee = Employee::where('id_employee',$id)->first();  

        $date_in = EmployeeController::formatFechaDiferencia($Employee->date_in);

        $PayrollTypes = PayrollType::where('active',1)->get();  
    
        return view('Employee.Form', compact('Contract','Position','Paises','Employee','date_in','PayrollTypes'));

    }

    public function formatFechaDiferencia($date)
    {
        return optional($date, function ($date) {
            $diferencia = Carbon::parse($date)->diff(Carbon::now());

            if ($diferencia->y < 1 && $diferencia->m < 1) {
                return $diferencia->format('%d Días');
            } elseif ($diferencia->y < 1) {
                return $diferencia->format('%m meses %d días');
            } else {
                return $diferencia->format('%y año, %m meses, %d días');
            }
        }) ?? '00/00/0000';
    }

    
}  