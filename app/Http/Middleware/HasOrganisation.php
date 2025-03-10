<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasOrganisation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $organisations_ids = collect($user->organisations->pluck('id')->toArray());
        if (
            $request->cookie('organisation') &&
            $organisations_ids->contains($request->cookie('organisation'))
        ) {
            return $next($request); // just early return if the cookie is already set
        }

        return redirect()->route('organisation.select');
    }
}
