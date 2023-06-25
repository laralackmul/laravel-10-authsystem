<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\DbNotificationServices;
use App\Services\UserService;

class RegisterController extends Controller
{
    private $dbNotificationService;
    private $userService;
    public function __construct(UserService $userService, DbNotificationServices $dbNotificationService)
    {
        $this->dbNotificationService = $dbNotificationService;
        $this->userService = $userService;
    }
    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }


    protected function create(array $data)
    {
        if (!empty($data['avatar'])) {
            $image_path = 'images/customer';
            $uploaded_image_path  = $data['avatar']->store($image_path);
            $uploaded_image_name_arr = explode('/', $uploaded_image_path);
            $uploaded_image_name = end($uploaded_image_name_arr);
        }

        $email_verification = date('Y-m-d H:i:s');
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'ip_address' => $data['ip_address'],
            'details' => $data['details'],
            'avatar_path' => $uploaded_image_path,
            'avatar_name' => $uploaded_image_name,
            'password' => bcrypt($data['password']),
            'email_verified_at' => $email_verification
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $requestData =  $request->all();
        $email = $requestData['email'];
        $response = $this->userService->createUser($requestData);

        $registration_status = $response->getStatus();
        $registration_message = $response->getMessage();
        if ($registration_status === true) {
            $notificationDetails = [
                'customer_name' => $requestData['name'],
                'customer_email' => $email
            ];
            $this->dbNotificationService->sendUserRegistrationNotification($notificationDetails);
            if (auth()->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                return redirect()
                    ->intended(route('userDashboard'))
                    ->with('status', 'You are Logged in as User!');
            }
            Session::flash('registration_message', true);
            // redirect user
            return redirect(route('user.showLoginForm'));
        } else {
            Session::flash('registration_failed', false);
            // redirect user
            return redirect(route('user.showLoginForm'));
        }
    }
}
