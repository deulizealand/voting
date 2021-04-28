<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $guard = 'admin';
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function guard()
    {
        //return Auth::guard('admin');
    }

    public function login(Request $request)
    {
        $login = request()->input('identity'); 
        
        // Check whether username or email is being used
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //$field    => $request->get('identity'),
        if (auth()->guard()->attempt([$field => $login, 'password' => $request->password ])) {
            
            return redirect(route('admin.dashboard'));
        }
        //Authentication failed...
        return $this->loginFailed();
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->flush(); 
        $request->session()->regenerate(); 
        return redirect()->route('admin');
    }
}
