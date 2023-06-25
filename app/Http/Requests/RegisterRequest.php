<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =
            [
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'details' => 'required|string',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            'password' => 'required|string|min:6|required_with:password_confirmation|same:password_confirmation',
            'g-recaptcha-response' => 'required|recaptcha'           
            ];
       
        return $rules;
    }
    public function messages()
    {
        $messages = [
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'details.required' => 'The Details field is required',
            'avatar.required' => 'Upload User Photo is required',
            'avatar.max'=> 'File size should not exceed 1mb',
            'password.required' => 'The Password field is required',
            'g-recaptcha-response.required' => 'Please complete the captcha' ,
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed'
                    
        ];
        return $messages;

    }
    protected function failedValidation(Validator $validator)
    {
        if ($this->header('accept') == "application/json") {
            $errors = [];
            if ($validator->fails()) {
                $e = $validator->errors()->all();
                foreach ($e as $error) {
                    $errors[] = $error;
                }
            }
            $json = [
                'success' => false,
                'data' => [],
                'message' => $errors[0],
            ];
            $response = new JsonResponse($json, 200);

            throw (new ValidationException($validator, $response))->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
        } else {           
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
    
}

