<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        do  {
            $loginToken = Str::random(60);
            $checkTokenExist = User::where('remember_token', '=', $loginToken)->first();  
        } 
        while( $checkTokenExist );
        
        $user = User::where('email', '=', $request->email)->first();
        $user->remember_token =  $loginToken;
        $user->token_expire_time = date('Y/m/d H:i:s', time()+1*60);
        $user->save();
        
        $response = array("token"=>$user->remember_token , "expire_time"=> $user->token_expire_time) ;        
        return response()->json(['message' => $response], 200);
    }


    public function show(Request $request)
    {
        return $request->user();
    }



    public function refreshToken(Request $request){
        $user = $request->user();
        $user->token_expire_time = date('Y/m/d H:i:s', time()+5*60);
        $user->save();

        $response = array("token"=>$user->remember_token , "expire_time"=> $user->token_expire_time) ;   
        return response()->json(['message' => $response], 200);
    }


}
