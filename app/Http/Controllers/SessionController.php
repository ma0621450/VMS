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
            return response()->json([
                'success' => false,
                'errors' => ['email' => 'Sorry, those credentials do not match.']
            ], 422);
        }

        $user = Auth::user();

        Session::put([
            'user_id' => $user->id,
            'role_id' => $user->role_id,
        ]);

        $request->session()->regenerate();

        $redirectUrl = match ($user->role_id) {
            1 => route('admin.customers'),
            2 => route('agency.packages'),
            3 => route('user.home'),
            default => route('user.home'),
        };

        return response()->json([
            'success' => true,
            'redirect' => $redirectUrl
        ]);
    }


    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }
}
