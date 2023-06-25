<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class GenericController extends Controller
{   
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    function publicProfile(Request $request){
        if(isset($request->id) && !empty($request->id))
        {
            $id = $request->id;
            $customerData = $this->userService->getUserDataById($id);
            if($customerData['users']===null)
            {
                return 'Data Not Found.';
            }
            else{
                $customerProfile = $customerData['users']->toArray(); 
                return view('user.auth.register', compact('customerProfile'));     
            }            
        }
        else{
            return "Invalid Request URL!";
        }
    }

    function showIpBlock(Request $request)
    {
        $message = session()->get('error');
       return view('user.block_ip',['message'=>$message]);
    }
}
