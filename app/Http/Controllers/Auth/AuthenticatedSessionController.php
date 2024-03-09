<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        $user = Auth::user(); // Assurez-vous d'avoir l'utilisateur authentifié
        if ($user->roles->contains('name', 'admin')) {
            return redirect('/dashboard');
        } elseif ($user->roles->contains('name', 'organisateur')) {
            return redirect('/Event');
        } elseif ($user->roles->contains('name', 'spectateur')) { // Vérifiez si l'utilisateur est un spectateur
            return redirect('/welcome'); // Redirection vers la page de bienvenue pour les spectateurs
        } else {
            return redirect('/welcome'); // Ou toute autre route par défaut pour les utilisateurs sans rôle spécifique
        }
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/welcome');
    }


}
