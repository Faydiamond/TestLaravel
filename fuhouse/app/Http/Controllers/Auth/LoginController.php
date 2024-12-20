<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        //dd($user);
        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::guard('users')->login($user);
                session(['role_id' => $user->role_id, 'user_id' => $user->id]);
                if ($user->role_id == 2) {
                    return redirect()->intended('users');
                }
                if ($user->role_id == 1) {
                    return redirect()->intended('reservations');
                }
            } else {

                return back()->withErrors([
                    'password' => 'La contraseña ingresada es incorrecta.',
                ]);
            }
        } else {
            return back()->withErrors([
                'email' => 'El correo ingresado no está registrado.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('users')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
