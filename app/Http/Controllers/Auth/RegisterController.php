<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function registerUsers(Request $request)
    {
        try {
            $rules = [
                "name" => "required|string|unique:users",
                "password" => "required|string",
                "email" => "required|email|unique:users",
            ];
            $message = [
                "name.required" => "請輸入name",
                "password.required" => "請輸入password",
                "email.required" => "請輸入email",
            ];
            $validResult = $request->validate($rules, $message);
        } catch (ValidationException $exception) {
            $errorMessage = $exception->validator->errors()->first();
            return response()->json([
                'message' => $errorMessage
            ], 400);
        }

        $newRegister = new User;
        $newRegister->name = $request->name;
        $newRegister->password = $request->password;
        $newRegister->email = $request->email;
        $newRegister->save();

        return response()->json(['message' => 'newUsers add success'], 201);
    }
}
