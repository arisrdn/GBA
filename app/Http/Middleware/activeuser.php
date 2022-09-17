<?php

namespace App\Http\Middleware;

use App\Helpers\APIFormatter;
use App\Models\GroupMember;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class activeuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $type)
    {
        $msg = 'not allowed';
        $hashedTooken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedTooken);
        $data = $token->tokenable;
        // $check = GroupMember::where('user_id', '=', $data->id):
        // dd($data->memberactive);
        if ($data->memberactive) {
            $check = $data->memberactive[0];
            if ($type == "join") {
                if ($check->leave_at == null && $check->complete_at == null && $check->transfer == null) {
                    return APIFormatter::responseAPI(403, $msg, null, 'Forbidden');
                }
                return $next($request);
            } else if ($type == "leave") {
                if ($check->leave_at == null && $check->complete_at == null && $check->transfer == null) {
                    return $next($request);
                }
                return APIFormatter::responseAPI(403, $msg, null, 'Forbidden');
            } else {
                if ($check->leave_at == null &&  $check->transfer == null) {
                    return $next($request);
                }
                return APIFormatter::responseAPI(403, $msg, null, 'Forbidden');
            }
            return APIFormatter::responseAPI(403, $msg, null, 'Forbidden');
        }
        return $next($request);
    }
}
