<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id == 2) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return back()->with('error', 'Akses Tidak Di Izinkan');
        }

        return $next($request);
    }
}


// <?php

// namespace App\Http\Middleware;

// use App\Models\User;
// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//      * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//      */
//     public function handle($request, Closure $next)
//     {
//         $user = User::where('email', $request->email)->first();
//         // dd($user);
//         if ($user->role_id == 2) {
//             return redirect("/login");
//         }
//         return $next($request);
//     }
// }
