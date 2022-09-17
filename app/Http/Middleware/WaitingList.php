<?php

namespace App\Http\Middleware;

use App\Helpers\APIFormatter;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

use function PHPSTORM_META\type;

class WaitingList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $msg = 'Waitting Approve';
        $hashedTooken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedTooken);
        $data = $token->tokenable;
        if ($data->waitinglist) {
            // dd($type);
            return APIFormatter::responseAPI(403, $msg, null, 'Forbidden');
            // if ($data->waitinglist->type == $type) {
            //     // return APIFormatter::responseAPI(429, $msg, null, ' Too Many Requests');
            // }
            // return $next($request);
        }
        return $next($request);
    }
}
