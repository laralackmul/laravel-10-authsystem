<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UserService
{

    public function __construct()
    {
    }

    public function createUser($request)
    {
        //dd($request);

        try {
            DB::beginTransaction();
            $image_path = 'images/customer';
            $uploaded_image_path  = $request['avatar']->store($image_path);
            $uploaded_image_name_arr = explode('/', $uploaded_image_path);
            $uploaded_image_name = end($uploaded_image_name_arr);
            $email_verification = date('Y-m-d H:i:s');
            $customerData =  Customer::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'details' => $request['details'],
                'avatar_path' => $uploaded_image_path,
                'avatar_name' => $uploaded_image_name,
                'password' => bcrypt($request['password']),
                'email_verified_at' => $email_verification,
                'status' => ACTIVE
            ]);
            if($customerData===null){
                DB::rollBack();
                return jsonResponse(TRUE)->message(__('Customer Registration failed.'));
            }
            else{
                $customer_id = $customerData->id;
                $host = request()->getHttpHost();
                $public_link=$host . '/public_profile/' .$customer_id;
                Customer::where('id', $customer_id)->update(['public_link' => $public_link]);
                DB::commit();
                return jsonResponse(TRUE)->message(__('Customer Registered successfully.'));
            }            
        } catch (\Exception $exception) {
            DB::rollBack();
            return jsonResponse(FALSE)->default();
        }
    }
    public function getUserData($id)
    {
        if ($id !== NULL) {
            $data['users'] = Customer::where('id', $id)->first();
        } else {
            $data['users'] = [];
        }
        return $data;
    }
    public function getUserDataById($id)
    {
        if ($id !== NULL) {
            $data['users'] = Customer::find($id);
        } else {
            $data['users'] = [];
        }
        return $data;
    }


    public function UserDelete($id)
    {
        if ($id !== NULL) {
            try {
                $user_delete =  Customer::where('id', $id)->update(['status' => DELETED]);
                if ($user_delete) {
                    return jsonResponse(TRUE)->message(__('Customer deleted successfully.'));
                } else {
                    return jsonResponse(TRUE)->message(__('Customer delete failed.'));
                }
            } catch (\Exception $exception) {
                return jsonResponse(FALSE)->default();
            }
        } else {
            return jsonResponse(FALSE)->default();
        }
    }

    
}
