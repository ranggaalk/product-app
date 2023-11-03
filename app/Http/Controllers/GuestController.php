<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GuestController extends Controller
{
    public function login(){
        $title = 'Login - '.env('APP_NAME');

        return view('guest.login', compact(['title']));
    }

    public function authLogin(Request $request){
        $validate = $request->validate([
            'email' => 'required', 'email',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($validate, $request->remember)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 2) {
                Alert::toast('Successfully logged in. Welcome '.Auth::user()->name, 'success');
                return redirect()->route('admin.dashboard');
            }
        }
        Alert::toast('Invalid Email/Password', 'error');
        return redirect()->back();
    }
}
