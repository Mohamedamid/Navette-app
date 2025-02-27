<?php

// AuthMiddleware.php;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::all();
        // Vérifie si l'utilisateur est authentifié
        if (!$user) {
            // Si non, redirige l'utilisateur vers la page de connexion
            return redirect('/login'); // Modifie cette URL si ton formulaire de connexion est à un autre endroit
        }

        // Si l'utilisateur est authentifié, on permet la requête de continuer
        return $next($request);
    }
}
