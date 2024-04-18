<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register
    public function register()
    {
        return view('user.register');
    }

    //show login
    public function login()
    {
        return view('user.login');
    }

    //create new user
    public function store(Request $request)
    {
        $formFields = $request->validate(
            [
                'username' => ['required' , Rule::unique('users','username')],
                'password' => ['required', 'confirmed', 'min:6']
            ]
        );

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        $banka = new Banka();
        $banka->user()->associate($user);
        $banka->save();

        auth()->login($user);

        return redirect('/banka');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required']
            ]
        );

        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();
            return redirect('/banka');
        }

        if (!User::where('username', $request->username)->exists()) {
            return back()->withErrors([
                'username' => "Username doesn't exist.",
            ]);
        }


        return back()->withErrors([
            'password' => 'Wrong password.'
        ])->withInput();
    }

}
