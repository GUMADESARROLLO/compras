<?php
namespace App\Http\Controllers;
use GMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\RequestsVacation;
use Carbon\Carbon;

class ApiController extends Controller{
    
    public function CalcDailyBalance()
    {  
        $today = date('Y-m-d');

        $activeEmployees = Employee::where('active', 1)->where('contract_type_id', 2)->get();
        foreach ($activeEmployees as $employee) {
            
            // Obtener todas las solicitudes pendientes de aprobación para el empleado
            $pendingRequests = RequestsVacation::where('employee_id', $employee->id_employee)
            ->where('end_date', '=', $today)
            ->where('request_status_id', 1) // Estado pendiente de aprobación
            ->get();

            foreach ($pendingRequests as $request) {
                // Cambiar el estado de las solicitudes aprobadas a Aplicadas
                $request->update(['request_status_id' => 2]);
            }

             // Restar los días de vacaciones de las solicitudes para el día actual
            $vacationDaysForToday = $pendingRequests->sum('requested_days');

             // Actualizar el campo balance_vacation
            $employee->vacation_balance += 0.0833 - $vacationDaysForToday;
            $employee->save();

          
        }
    }
}