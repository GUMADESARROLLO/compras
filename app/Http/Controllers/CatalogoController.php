<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogos;
use App\Models\Contract;
use App\Models\Company;
use App\Models\Department;
use App\Models\Position;

class CatalogoController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getCatalogos()
    {        
        $Contract = Contract::where('active',1)->get();  
        $Companys = Company::where('active',1)->get();
        $Department = Department::where('active',1)->get();
        $Position = Position::where('active',1)->get();

        return view('Catalogos.Home', compact('Contract','Companys','Department','Position'));
    }

    public function AddCatalogo(Request $request)
    {        
        $response = Catalogos::AddCatalogo($request);
        return response()->json($response);
    }
    public function rmCatalogo(Request $request)
    {        
        $response = Catalogos::rmCatalogo($request);
        return response()->json($response);
    }
    public function UpdateCatalogo(Request $request)
    {        
        $response = Catalogos::UpdateCatalogo($request);
        return response()->json($response);
    }

    
}  