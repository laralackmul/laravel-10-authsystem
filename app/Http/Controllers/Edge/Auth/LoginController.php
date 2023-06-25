<?php

namespace App\Http\Controllers\Edge\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public function __construct()
    {
    }
    public function showLoginForm()
    {
        return view('user.auth.userlogin', ['url' => route('edge.login'), 'title' => 'Admin']);
    }
    public function login(LoginRequest $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()
                ->intended(route('edgeDashboard'))
                ->with('success', 'You are Logged in as Admin!');
        }
        return $this->loginFailed();
    }    
   
    private function loginFailed()
    {
        return view('user.auth.userlogin', ['url' => route('edge.login'), 'title' => 'Admin', 'error' => 'Wrong user or password! please try again!']);        
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('user.login')
            ->with('success', 'Admin has been logged out!');       
    }
}
