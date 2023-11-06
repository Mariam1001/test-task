<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        if (auth()->user()) {
            return redirect()->route('accounts.index');
        } else {
            return view('frontend.login.index');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->createToken('MyApp')->plainTextToken;
            return redirect()->route('accounts.index');
        } else {
            return redirect()->route('frontend.loginView');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        return redirect()->route('frontend.loginView');
    }
}
