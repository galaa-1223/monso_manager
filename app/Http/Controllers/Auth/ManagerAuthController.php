<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequestManager;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Manager;

use Auth;

class ManagerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/manager/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function managerGet()
    {
        return redirect(url('manager/login'));
    }

    public function managerGetLogin()
    {
        return view('manager.login.main', [
            'layout' => 'login'
        ]);
    }

    public function ManagerLogin(LoginRequestManager $request)
    {
        
        if (Auth::guard('manager')->attempt([
                'email' => $request->email, 
                'password' => $request->password
            ]))
        {
            $user = Auth::guard('manager')->user();
            
        } else {
            throw new \Exception('Wrong email or password.');
        }
    }

    public function managerLogout()
    {
        Auth::guard('manager')->logout();   
        return redirect(url('manager/login'));
    }
}