<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsVacation extends Model {
    public $timestamps = false;
    protected $table = "tbl_vacation_request";
    protected $fillable = ['request_status_id'];
    protected $primaryKey = 'id_vacation_request';
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id_employee');
    }
    public function Status()
    {
        return $this->belongsTo(RequestStatus::class, 'request_status_id','id_request_status');
    }
    public static function SaveTypeRequest(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Nombre           = $request->input('Nombre_');
                $Modelo           = $request->input('Modelo_');

                if ($Modelo === 'Tipos') {
                    $datos_a_insertar[0] = [
                        'type_name' => $Nombre ,
                        'active' => 1
                        
                    ];
                    $response = RequestsType::insert($datos_a_insertar); 
                } elseif($Modelo === 'Estados') {
                    $datos_a_insertar[0] = [
                        'status_name' => $Nombre ,
                        'active' => 1
                        
                    ];
                    $response = RequestStatus::insert($datos_a_insertar); 
                }
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function rmRequests(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Id           = $request->input('id_');
                $Mdl           = $request->input('mdl_');


                if ($Mdl == 1) {
                    $response =  RequestsType::where('id_request_type',  $Id)->update([
                        "active" => 0,
                    ]);
    
                } elseif($Mdl == 2) {
                    $response =  RequestStatus::where('id_request_status',  $Id)->update([
                        "active" => 0,
                    ]);
                } elseif($Mdl == 3) {
                    $response =  RequestsVacation::where('id_vacation_request',  $Id)->update([
                        "active" => 0,
                    ]);
                }
                

               
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function UpdateRequest(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Id           = $request->input('ID_');
                $Name           = $request->input('Nombre_');
                $Model           = $request->input('Modelo_');


                if ($Model == 1) {
                    $response =  RequestsType::where('id_request_type',  $Id)->update([
                        "type_name" => $Name,
                    ]);
    
                } elseif($Model == 2) {
                    $response =  RequestStatus::where('id_request_status',  $Id)->update([
                        "status_name" => $Name,
                    ]);
                }
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function SaveRequest(Request $request)
    {
            try {
                DB::transaction(function () use ($request) {
                    $IdRequest_          = $request->input('IdRequest_');
                    $employee_           = $request->input('employee_');
                    $date_ini_           = $request->input('date_ini_');
                    $date_end_           = $request->input('date_end_');
                    $date_return_        = $request->input('date_return_');
                    $list_type_          = $request->input('list_type_');
                    $cant_day_           = $request->input('cant_day_');
                    $observation_        = $request->input('observation_');


                    $datos_a_insertar = [
                        'employee_id'       => $employee_ ,
                        'start_date'        => $date_ini_ ,
                        'end_date'          => $date_end_ ,
                        'return_date'       => $date_return_ ,
                        'request_type_id'   => $list_type_ ,
                        'requested_days'    => $cant_day_ ,
                        'observation'       => $observation_ ,
                        'active'            => 1
                    ];

                    if ($IdRequest_ > 0) {
                        RequestsVacation::where('id_vacation_request',  $IdRequest_)->update($datos_a_insertar);
                    } else {
                        RequestsVacation::insert($datos_a_insertar);
                    }
                    

                    
                }); 
                
            } catch (Exception $e) {
                
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        
    }

}
