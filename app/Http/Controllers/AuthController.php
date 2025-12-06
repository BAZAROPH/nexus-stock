<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller {
    //
    public function loginView(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->first_login){
                return redirect()->route('first.login');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'error' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function verifyEmail(Request $request){
        $user = User::find($request->id);

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard')->with('info', 'Votre adresse e-mail est déjà vérifiée.');
        }

        $user->markEmailAsVerified();
        $user->save();

        return redirect()->route('login')->with('success', 'Merci d\'avoir vérifié votre adresse e-mail.');
    }

    public function firstLoginView(){
        return view('auth.first_login');
    }

    public function firstLogin(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($validated['password']);
        $user->first_login = false;
        $user->save();

        return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès. Veuillez vous reconnecter.');
    }
}
