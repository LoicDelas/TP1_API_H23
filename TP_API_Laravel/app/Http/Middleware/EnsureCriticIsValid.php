<?php

namespace App\Http\Middleware;

use App\Models\Critic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCriticIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::id() != $request->user_id)
        {
            abort(403, 'Vous n\'êtes pas autorisé à ajouter une critique pour un autre utilisateur');
        }

        if ($request->film_id != $request->route('id'))
        {
            abort(409, 'Le film_id indiqué dans l\'url ne correspond pas au film_id inscrit dans la requête');
        }

        if (Critic::where('user_id', Auth::id())->where('film_id', $request->film_id)->exists())
        {
            abort(409, 'Une critique pour ce film existe déjà pour cet utilisateur');
        }

        return $next($request);
    }
}
