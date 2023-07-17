<?php

namespace App\Http\Controllers\Auth;

<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
=======
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
>>>>>>> f89a811 (First Commit : Progress 80%)
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
<<<<<<< HEAD

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }
    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
}
