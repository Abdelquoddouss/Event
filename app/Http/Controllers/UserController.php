<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       
        $users = User::with('roles')->get();
        return view('Admin.index',compact('users'));
    }


    

    public function create()
    {
        // Logique pour afficher le formulaire de création d'utilisateur
    }

    public function store(Request $request)
    {
        // Logique pour traiter le formulaire de création d'utilisateur
    }

    public function show($id)
    {
        // Logique pour afficher les détails d'un utilisateur spécifique
    }

    public function edit($id)
    {
        // Logique pour afficher le formulaire de modification d'utilisateur
    }

    public function update(Request $request, $id)
    {
        // Logique pour traiter le formulaire de modification d'utilisateur
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id); // Récupérer l'utilisateur à supprimer
    
        $users->delete(); // Supprimer l'utilisateur
    
        return redirect()->route('dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
