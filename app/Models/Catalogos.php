<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;


class Catalogos extends Model {
    public $timestamps = false;
    public static function AddCatalogo(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Nombre           = $request->input('Nombre_');
                $Modelo           = $request->input('Modelo_');
                $Company           = $request->input('UND_');


                if ($Modelo === 'Contrato') {
                    $datos_a_insertar[0] = [
                        'contract_type_name' => $Nombre ,
                        'active' => 1
                        
                    ];
                    $response = Contract::insert($datos_a_insertar); 
                } elseif($Modelo === 'Unidad de Negocio') {
                    $datos_a_insertar[0] = [
                        'company_name' => $Nombre ,
                        'active' => 1
                        
                    ];
                    $response = Company::insert($datos_a_insertar); 
                }elseif($Modelo === 'Departamento') {
                    $datos_a_insertar[0] = [
                        'department_name' => $Nombre ,
                        'company_id' => $Company,
                        'active' => 1
                        
                    ];
                    $response = Department::insert($datos_a_insertar); 
                }elseif($Modelo === 'Posicion') {
                    $datos_a_insertar[0] = [
                        'position_name' => $Nombre ,
                        'department_id' => $Company,
                        'active' => 1
                        
                    ];
                    $response = Position::insert($datos_a_insertar); 
                }
                

               
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function rmCatalogo(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Id           = $request->input('id_');
                $Mdl           = $request->input('mdl_');


                if ($Mdl == 1) {
                    $response =  Contract::where('id_contract_type',  $Id)->update([
                        "active" => 0,
                    ]);
    
                } elseif($Mdl == 2) {
                    $response =  Company::where('id_compy',  $Id)->update([
                        "active" => 0,
                    ]);
                }elseif($Mdl == 3) {
                    $response =  Department::where('id_department',  $Id)->update([
                        "active" => 0,
                    ]);
                    
                }elseif($Mdl == 4) {
                    $response =  Position::where('id_position',  $Id)->update([
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
    public static function UpdateCatalogo(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Id           = $request->input('ID_');
                $Name           = $request->input('Nombre_');
                $Model           = $request->input('Modelo_');
                $Select           = $request->input('Select_');


                if ($Model == 1) {
                    $response =  Contract::where('id_contract_type',  $Id)->update([
                        "contract_type_name" => $Name,
                    ]);
    
                } elseif($Model == 2) {
                    $response =  Company::where('id_compy',  $Id)->update([
                        "company_name" => $Name,
                    ]);
                }elseif($Model == 3) {
                    $response =  Department::where('id_department',  $Id)->update([
                        "department_name" =>  $Name,
                        "company_id" =>  $Select,
                    ]);
                    
                }elseif($Model == 4) {
                    $response =  Position::where('id_position',  $Id)->update([
                        "position_name" =>  $Name,
                        "department_id" =>  $Select,
                    ]);
                }
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }
    public static function Nacionalidades(){

        $paises = [ "AF" => "Afganistán", "AL" => "Albania", "DE" => "Alemania", "AD" => "Andorra", "AO" => "Angola", "AG" => "Antigua y Barbuda", "SA" => "Arabia Saudita", "DZ" => "Argelia", "AR" => "Argentina", "AM" => "Armenia", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaiyán", "BS" => "Bahamas", "BD" => "Bangladés", "BB" => "Barbados", "BH" => "Baréin", "BE" => "Bélgica", "BZ" => "Belice", "BJ" => "Benín", "BY" => "Bielorrusia", "BO" => "Bolivia", "BA" => "Bosnia y Herzegovina", "BW" => "Botsuana", "BR" => "Brasil", "BN" => "Brunéi", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "BT" => "Bután", "CV" => "Cabo Verde", "KH" => "Camboya", "CM" => "Camerún", "CA" => "Canadá", "QA" => "Catar", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CY" => "Chipre", "VA" => "Ciudad del Vaticano", "CO" => "Colombia", "KM" => "Comoras", "KP" => "Corea del Norte", "KR" => "Corea del Sur", "CI" => "Costa de Marfil", "CR" => "Costa Rica", "HR" => "Croacia", "CU" => "Cuba", "DK" => "Dinamarca", "DM" => "Dominica", "EC" => "Ecuador", "EG" => "Egipto", "SV" => "El Salvador", "AE" => "Emiratos Árabes Unidos", "ER" => "Eritrea", "SK" => "Eslovaquia", "SI" => "Eslovenia", "ES" => "España", "US" => "Estados Unidos", "EE" => "Estonia", "ET" => "Etiopía", "PH" => "Filipinas", "FI" => "Finlandia", "FJ" => "Fiyi", "FR" => "Francia", "GA" => "Gabón", "GM" => "Gambia", "GE" => "Georgia", "GH" => "Ghana", "GD" => "Granada", "GR" => "Grecia", "GT" => "Guatemala", "GY" => "Guyana", "GN" => "Guinea", "GQ" => "Guinea Ecuatorial", "GW" => "Guinea-Bisáu", "HT" => "Haití", "HN" => "Honduras", "HU" => "Hungría", "IN" => "India", "ID" => "Indonesia", "IQ" => "Irak", "IR" => "Irán", "IE" => "Irlanda", "IS" => "Islandia", "MH" => "Islas Marshall", "SB" => "Islas Salomón", "IL" => "Israel", "IT" => "Italia", "JM" => "Jamaica", "JP" => "Japón", "JO" => "Jordania", "KZ" => "Kazajistán", "KE" => "Kenia", "KG" => "Kirguistán", "KI" => "Kiribati", "KW" => "Kuwait", "LA" => "Laos", "LS" => "Lesoto", "LV" => "Letonia", "LB" => "Líbano", "LR" => "Liberia", "LY" => "Libia", "LI" => "Liechtenstein", "LT" => "Lituania", "LU" => "Luxemburgo", "MG" => "Madagascar", "MY" => "Malasia", "MW" => "Malaui", "MV" => "Maldivas", "ML" => "Malí", "MT" => "Malta", "MA" => "Marruecos", "MU" => "Mauricio", "MR" => "Mauritania", "MX" => "México", "FM" => "Micronesia", "MD" => "Moldavia", "MC" => "Mónaco", "MN" => "Mongolia", "ME" => "Montenegro", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NI" => "Nicaragua", "NE" => "Níger", "NG" => "Nigeria", "NO" => "Noruega", "NZ" => "Nueva Zelanda", "OM" => "Omán", "NL" => "Países Bajos", "PK" => "Pakistán", "PW" => "Palaos", "PS" => "Palestina", "PA" => "Panamá", "PG" => "Papúa Nueva Guinea", "PY" => "Paraguay", "PE" => "Perú", "PL" => "Polonia", "PT" => "Portugal", "GB" => "Reino Unido", "CF" => "República Centroafricana", "CZ" => "República Checa", "MK" => "República de Macedonia", "CG" => "República del Congo", "CD" => "República Democrática del Congo", "DO" => "República Dominicana", "ZA" => "República Sudafricana", "RW" => "Ruanda", "RO" => "Rumanía", "RU" => "Rusia", "WS" => "Samoa", "KN" => "San Cristóbal y Nieves", "SM" => "San Marino", "VC" => "San Vicente y las Granadinas", "LC" => "Santa Lucía", "ST" => "Santo Tomé y Príncipe", "SN" => "Senegal", "RS" => "Serbia", "SC" => "Seychelles", "SL" => "Sierra Leona", "SG" => "Singapur", "SY" => "Siria", "SO" => "Somalia", "LK" => "Sri Lanka", "SZ" => "Suazilandia", "SD" => "Sudán", "SS" => "Sudán del Sur", "SE" => "Suecia", "CH" => "Suiza", "SR" => "Surinam", "TH" => "Tailandia", "TZ" => "Tanzania", "TJ" => "Tayikistán", "TL" => "Timor Oriental", "TG" => "Togo", "TO" => "Tonga", "TT" => "Trinidad y Tobago", "TN" => "Túnez", "TM" => "Turkmenistán", "TR" => "Turquía", "TV" => "Tuvalu", "UA" => "Ucrania", "UG" => "Uganda", "UY" => "Uruguay", "UZ" => "Uzbekistán", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "Vietnam", "YE" => "Yemen", "DJ" => "Yibuti", "ZM" => "Zambia", "ZW" => "Zimbabue" ];

        return $paises;
    }
}
