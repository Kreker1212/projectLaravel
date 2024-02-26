<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view(): View
    {
        return view('doctor.doctor_login');
    }

    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials) && auth()->user()->admin_is == null) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect(route('admin'));
        }

        return redirect()->back()->withErrors('Error');
    }

    public function loginDoctor(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('doctors')->attempt($credentials)){
            return redirect(route('doctor'));
        }

        return(redirect('login'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
