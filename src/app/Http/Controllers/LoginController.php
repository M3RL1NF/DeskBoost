<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return view('login');
        }
        else {
            return view('booking');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return view('login');
    }

    public function handle(Request $request)
    {        
        $user = User::where('email', $request->input('email'))->firstOrCreate([
            'first_name' => "name",
            'last_name' => "name",
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $request->session()->put('user_id', $user->id);

        return view('booking');
    }
}
