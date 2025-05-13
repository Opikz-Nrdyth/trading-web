<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WebRediarect
{
    public function handle(Request $request, Closure $next)
    {
        if ($reff = $request->query('reff')) {
            // Store the referral code in session
            session(['reff' => $reff]);

            // Only redirect if on homepage
            if ($request->path() === '/' || $request->path() === '') {
                return redirect()->route('filament.admin.auth.regist');
            }
        }

        return $next($request);
    }
}
