<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function password()
    {
        return view('auth.password-forget');
    }
    
    public function reset(Request $request, $token)
    {
        return view('auth.password-reset',[
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiant ou mot de passe incorrect !',
        ])->onlyInput('email');
    }
    
    public function sendResetLink(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);
       $user = User::where('email', $credentials['email'])->first();
        if(!$user)
            return back()->withErrors([
                'email' => 'adresse email introuvable !',
            ])->onlyInput('email');

        // $token = Str::random(100);
        // $date = date('Y-m-d H:i:s');
        // $done = DB::table('password_reset_tokens')->upsert([
        //     'email' => $user->email,
        //     'token' => $token,
        //     'created_at' => $date,
        // ], 'email', ['token' => $token, 'created_at' => $date]);

        Password::sendResetLink(['email' => $user->email]);

        return back()->with('success', "Un lien de réinitialisation a été envoyé à votre adresse email");
    }
    
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // Optionnel : tu peux aussi automatiquement connecter l'utilisateur ici
                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? back()->with('fail', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}