<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       
        $users = User::with('roles')->get();
        return view('Admin.index',compact('users'));
    }

    
    public function search(Request $request)
    {
        $category_id = $request->query('category_id');

        $events = Event::where('categorie_id', $category_id)->take(3)->get();
        
        $eventData = [];

        foreach ($events as $event) {
            $eventData[] = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'status' => $event->status,
                'image_url' =>  $event->getFirstMediaUrl('eventImage'),
            ];
        }
        return response()->json($eventData);
    }

    public function index2()
    {
        $categories = Categorie::all(); // Récupère toutes les catégories
    $events = Event::where('status', Event::STATUS_ACCEPTED)->paginate(3); // Récupère tous les événements acceptés
    return view('welcome', compact('events', 'categories'));
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
