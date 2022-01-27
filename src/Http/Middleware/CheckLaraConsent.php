<?php

namespace Ekoukltd\LaraConsent\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLaraConsent
{
    public function handle(Request $request, Closure $next)
    {
        if ($user = $request->user()) {
            $isConsentRoute = str_starts_with($request->route()->getName(),config('laraconsent.routes.user.prefix'))
                ||str_starts_with($request->route()->getName(),config('laraconsent.routes.admin.prefix'));
            if (!$isConsentRoute && !$request->ajax() && !$user->hasRequiredConsents() ) {
                $request->session()->put('url.saved',$request->fullUrl());
                return redirect()->route((config('laraconsent.routes.user.prefix').'.request'));
            }
        }
        return $next($request);
    }
}