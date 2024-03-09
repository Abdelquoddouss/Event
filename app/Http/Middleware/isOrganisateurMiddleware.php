<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isOrganisateurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();

        if (!$user) {
            return abort(403);
        }
    
        foreach ($user->roles as $role) { // Assurez-vous que c'est `$user->roles`
            if ($role->name === 'organisateur') {
                return $next($request);
            }
        }
    
        return abort(403);
}

}
