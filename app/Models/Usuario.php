<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model {
    protected $table = "users";
    protected $connection = 'mysql';
    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'role_id','id');
    }


    public static function getUsuarios()
    {
        return Usuario::where('active',1)->get();
    }
    public static function SaveUsuario(Request $request) {
        if ($request->ajax()) {
            try {

                $usuario        = $request->input('usuario');
                $nombre         = $request->input('nombre');
                $passwprd       = Hash::make($request->input('passwprd'));
                $Estado         = $request->input('Estado');
                $id_rol         = $request->input('id_rol');


                if ($Estado=="0") {
                    $obj = new Usuario();   
                    $obj->username      = $usuario;                
                    $obj->nombre        = $nombre;
                    $obj->password      = $passwprd;
                    $obj->role_id       = $id_rol;
                    $obj->active        = 1;                 
                    $response = $obj->save();
                } else {
                    $response =   Usuario::where('id',  $Estado)->update([
                        "username" => $usuario,
                        "nombre" => $nombre,
                        "role_id" => $id_rol,
                    ]);
                }

                return response()->json($response);
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function SaveAssigned(Request $request) {
        if ($request->ajax()) {
            try {

                $IdUser        = $request->input('IdUser_');
                $IdEmployee    = $request->input('IdEmployee_');

                $response = Assigned::insert([
                    'users_id' => $IdUser ,
                    'employee_id' => $IdEmployee
                    
                ]); 

                return response()->json($response);
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function rmAssigned(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Id           = $request->input('id_');
                $IdUser       = $request->input('IdUser_');
                $response =  Assigned::where('users_id',  $IdUser)->where('employee_id',  $Id)->delete();
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function DeleteUsuario(Request $request)
    {
        if ($request->ajax()) {
            try {

                $id     = $request->input('id');
                
                $response =   Usuario::where('id',  $id)->update([
                    "activo" => 'N',
                ]);

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
}