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
            // dd(Auth::user()->level);
            if (auth()->user()->level == "Admin") {
                return redirect(route('admin-dashboard'));
                //dd("admin ganteng");
            } 
            if (auth()->user()->level == "Kepala Puskesmas") {
                return redirect()->intended('kepala-puskesmas');
                //dd("kepala-puskesmas");
            }
            if (auth()->user()->level == "Petugas UKM") {
                return redirect()->intended('petugas-ukm');
                //dd("kepala-puskesmas");
            }  
            return back()->withErrors('Error');
        }

        return redirect(route('loginPage'))->with('error', 'NIP dan Password yang anda masukan salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('loginPage'))->with('success', 'Sesi anda berhasil dihapus');
    }

}
