<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Return a login view.
     */
    public function show ()
    {
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout ()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    /**
     * Try to auth user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function action (Request $request)
    {
        $this->validate($request, [
           'usernameOrEmail' => 'required',
           'password' => 'required',
        ]);

        $data = $this->getAttemptValues();

        if(auth()->attempt($data, $request->get('remember_me'))) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Неверные данные.');
    }

    /**
     * @return mixed
     */
    public function getAttemptValues ()
    {
        $data['password'] = Input::get('password');

        $uoe = Input::get('usernameOrEmail');

        if(filter_var($uoe, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $uoe;
        }else {
            $data['username'] = $uoe;
        }

        return $data;
    }
}
