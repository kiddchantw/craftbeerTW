<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

use App\BrewerysStores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class BreweryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerPolicies();
        
        Auth::viaRequest('custom-token', function ($request) {
            $user = BrewerysStores::where('remember_token', "=", $request->remember_token)->first();
            if ($user){
                $nowTimeStr = strtotime(date('Y/m/d H:i:s', time()));
                $tokenTimeStr = strtotime($user->token_expire_time);
                if ($tokenTimeStr > $nowTimeStr) {
                    return $user;
                } else {
                    return null;
                }
            }
        });
    }
}
