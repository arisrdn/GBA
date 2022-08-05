<?php

namespace App\Http\Middleware;

use App\Helpers\APIFormatter;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class EnsureEmailIsVerifiedAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   $msg='Kindly verify your email to complete your account registration.';
        $hashedTooken=$request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedTooken);
        $data = $token->tokenable;
        // $data->hasVerifiedEmail();
        if ( !$data['email_verified_at']) {
            return APIFormatter::responseAPI(403, $msg,null,'Forbidden' ); 
    }

    // return 'sudah';
            
        // dd( $data['']);
        // dd($request->header('Authorization'));

        return $next($request);
    }
}
