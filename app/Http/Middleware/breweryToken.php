<?php

namespace App\Http\Middleware;

use Closure;
use App\BrewerysStores;


class breweryToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $stores = BrewerysStores::where('remember_token', '=', $request->remember_token)->first();
        if ($stores != Null) {
            // $request->merge(['user' => $stores]);
            // //add this
            // $request->setUserResolver(function () use ($stores) {
            //     return $stores;
            // });
            // if you dump() you can now see the $request has it
            // dump($request->user());

            $nowTimeStr = strtotime(date('Y/m/d H:i:s', time()));
            $tokenTimeStr = strtotime($stores->token_expire_time);
            if ($tokenTimeStr > $nowTimeStr) {
                return $next($request);
            } else {
                return response()->json(['message' => 'BrewerysStores Token overtime'], 404);
            }
        } else {
            return response()->json(['message' => 'BrewerysStores Token not found '], 404);
        }
    }
}
