<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Return a user settings view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ()
    {
        return view('user.settings');
    }

    public function security (Request $request)
    {
        $this->validate($request, [
           'password' => 'required|min:4',
        ]);

        u()->update([
           'password' => bcrypt($request->get('password'))
        ]);

        return redirect()->back()->with('success', 'Пароль успешно изменен.');
    }

    public function primary (Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email|unique:users,email,'.u()->email,
        ]);

        u()->update([
           'email' => $request->get('email'),
        ]);

        return redirect()->back()->with('success', 'Основные настройки успешно изменены.');
    }
}
