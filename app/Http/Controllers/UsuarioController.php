<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Roles;
use App\Models\Employee;

class UsuarioController extends Controller {
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function getUsuarios()
    {  
        $Usuarios   = Usuario::getUsuarios();
        $Roles      = Roles::getRoles();
        return view('Usuario.Home', compact('Usuarios','Roles'));
    }
    public function SaveUsuario(Request $request)
    {
        $response = Usuario::SaveUsuario($request);
        return response()->json($response);
    }
    public function Asignar($id_employee)
    {
        $Employee = Employee::where('active',1)->get();
        $Assigned = Employee::Assigned($id_employee);
        return view('Usuario.Asignar',compact('Employee','id_employee','Assigned'));
    }
    public function SaveAssigned(Request $request)
    {
        $response = Usuario::SaveAssigned($request);
        return response()->json($response);
    }
    public function rmAssigned(Request $request)
    {        
        $response = Usuario::rmAssigned($request);
        return response()->json($response);
    }
    
}  