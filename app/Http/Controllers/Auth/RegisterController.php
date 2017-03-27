<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param $data
     */
    protected function validator(Request $data)
    {
        return $this->validate($data, [
            'username' => 'required|max:15|min:3',
            'email' => 'required|max:255',
            'password' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param $data
     * @return User
     */
    protected function create(Request $data)
    {
        return User::create([
            'username' => $data->get('username'),
            'email' => $data->get('email'),
            'password' => bcrypt($data->get('password')),
            'is_admin' => 0,
        ]);
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function action (Request $request)
    {
        $this->validator($request);

        $user = $this->create($request);

        if($user) {
            auth()->loginUsingId($user->id);

            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Во время регистрации произошла ошибка.');
    }
}
