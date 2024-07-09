<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        $user = Auth::user();

        Session::put([
            'user_id' => $user->id,
            'role_id' => $user->role_id,
        ]);

        $request->session()->regenerate();

        if ($user->role_id === 1) {
            return redirect('/admin');
        } else if ($user->role_id === 2) {
            return redirect('/agency/packages');
        } else if ($user->role_id === 3) {
            return redirect('/');
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
