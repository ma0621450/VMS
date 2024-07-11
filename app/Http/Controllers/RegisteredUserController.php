<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TravelAgency;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'phone_number' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer']
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);


        if ($attributes['role_id'] == 2) {
            TravelAgency::create(['user_id' => $user->user_id]);
        } elseif ($attributes['role_id'] == 3) {
            Customer::create(['user_id' => $user->user_id]);
        }

        return redirect('/login');
    }
}