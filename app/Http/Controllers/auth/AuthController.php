<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        //Validatie 
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        //Check Credentials
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(auth()->user()->status == "inactive"){
                Auth::logout();
                return redirect()->back()->with('error', 'Data pengguna tidak ditemukan');
            }
            return redirect(route('admin-dashboard'));
        }

        return redirect(route('loginPage'))->with('error', 'NIP dan Password yang anda masukan salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('loginPage'))->with('success', 'Sesi anda berhasil dihapus');
    }

}
