<?php

namespace Ekoukltd\LaraConsent\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForceRedirectToUnapprovedConsents
{
    public function handle(Request $request, Closure $next)
    {
    
        $isConsentRoute = str_starts_with($request->route()->getName(),config('laraconsent.routes.user.prefix'))
            ||str_starts_with($request->route()->getName(),config('laraconsent.routes.admin.prefix'));
        
        if (
        //must be logged in
            Auth::user()
        //have the trait installed
            && method_exists(Auth::user(),'hasRequiredConsents')
        //Not be a consent route
            && !$isConsentRoute
        //Not an ajax call
            && !$request->ajax()
        //Not have required consents signed
            && !Auth::user()->hasRequiredConsents()
        
        ) {
                //Save current request URL
                $request->session()->put('url.saved',$request->fullUrl());
                //Redirect user to ask for consent
                return redirect()->route((config('laraconsent.routes.user.prefix').'.request'));
        }
        return $next($request);
    }
}