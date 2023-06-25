<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
//use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    //private $session; 
    public function __construct()
    {
        //$this->session = new Session();
    }
    public function showLoginForm()
    {
        return view('user.auth.userlogin');
    }
    public function login(LoginRequest $request)
    {
        $myIp = $request->ip();
        $key = Str::lower(request('email')) . '|' . request()->ip();
        if (auth()->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            if(auth()->user()->status==ACTIVE)
            {
                if(cache()->has($key))
                {
                    cache()->forget($key);
                }
                return redirect()
                    ->intended(route('userDashboard'))
                    ->with('status', 'You are Logged in as User!');
            }
            else{
                return $this->loginFailed();
            }            
        }
        else{ 
            if (cache()->has($key)) {
                $previous_count = cache()->get($key);
                $current_count = (int)$previous_count + 1;
                cache()->put($key, $current_count);
            } else {
                cache()->put($key, 1);
            }

            if (cache()->get($key) === 3) {
                cache()->put($myIp, BLOCK_THREE_ATTEMPT, BLOCK_THREE_ATTEMPT);
            }

            if (cache()->get($key) == 6) {
                cache()->put($myIp, BLOCK_SIX_ATTEMPT, BLOCK_SIX_ATTEMPT);
                cache()->forget($key);
            }
            return $this->loginFailed();
        }
    }   

    private function loginFailed()
    {
        Session::flash('error', 'Wrong user or password! please try again!');

        return redirect()
            ->back()
            ->withInput();
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()
            ->route('user.login')
            ->with('success', 'User has been logged out!');
    }
}
