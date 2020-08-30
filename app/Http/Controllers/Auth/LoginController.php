<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
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
    protected $redirectTo = '/profile';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticate(Request $request){
        error_log('Something');
        $tvar = $request->input('email');
        $pw = $request->input('password');

        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'confirmed' => 1
        ];
        if ( ! Auth::attempt($credentials))
        {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'status' => 'credentials_error'
                ]);
        }
        if ($this->attempt(['email' => $tvar, 'password' => $pw, 'admin' => 1]))
        {
            return redirect()->intended('pages/adminservices');
        } else {
            return redirect()->intended('pages/userservices');
        }


    }
}
