<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $token = $request->header('token');
//        echo env('BROADCAST_DRIVER');die;
//        if (trim($token) != env('TOKEN')) {
        if (trim($token) != '5a16a5e50af69') {
//            echo $token . '</br>' . env('TOKEN');
//            die;
            return response()->json(array('success' => false, 'message' => 'You are Un-authorized to perform this action'), 401);
        }

        return $next($request);
    }

}
