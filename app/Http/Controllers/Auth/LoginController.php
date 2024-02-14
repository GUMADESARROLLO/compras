<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    public function redirectTo() {

        // $role = Auth::User()->role_id;

        // switch ($role) {
        //     case '1':
        //         return 'Home';
        //     break;

        //     case '2':
        //         return 'Requests';
        //     break;

        //     default:
        //         return '/';
        //     break;
        // }
        return 'Requests';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return 'username';
    }
    public function logout () {        
        auth()->logout();
        return redirect('/');
    }
    public function login(Request $request) {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $user = $request->username;
        $queryResult = DB::table('users')->where('username', $user)->where('active', 1)->pluck('id');
        if (!$queryResult->isEmpty()) {
            if ($this->attemptLogin($request)) {

                $Info_usuario = Usuario::find($queryResult);
                $Bodegas = '';

                foreach($Info_usuario as $user)
                {                
                    $request->session()->put('name_session', $user->username);
                    $request->session()->put('name_rol', $user->rol->role_name);
                    $request->session()->put('rol', $user->role_id);               
                }

                return $this->sendLoginResponse($request);
            }
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm()
    {
        return view('Usuario.form_login');
        
    }
}
