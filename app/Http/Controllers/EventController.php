<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Models\Categorie;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('created_by_user_id', Auth::id())->get();
        return view('Organisateur.AfficherEvent', compact('events'));
    }

    public function create()
    {
        $events = Event::all();
        $categories = Categorie::all();

        return view('Organisateur.CreateEvent', compact('events','categories'));
    }

   
    public function store(Request $request)
{    
    $autoValue = $request->input('auto');
    
    $eventData = $request->all();
    $eventData['created_by_user_id'] = Auth::id();
    $eventData['auto'] = $autoValue;

    // Ajoute l'ID de l'utilisateur connecté aux données de l'événement
    $eventData['user_id'] = Auth::id();
    $event = Event::create($eventData);
    
    // Ajoute l'image de l'événement, si elle est présente dans la requête
    if($request->hasFile("event_image")){
        $event->addMediaFromRequest("event_image")->toMediaCollection("eventImage");
    }
    return redirect()->route('Event.index')->with('success', 'Événement ajouté avec succès');
}


    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Categorie::all();
        return view('Organisateur.EditeEvente', compact('event','categories'));
    }

    public function update(Request $request, string $id)
    {
        $events = Event::find($id);
        $events->update($request->all());
        return redirect()->route('Event.index')->with('success', 'Project mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();
    return redirect()->route('Event.index')->with('success', 'Event supprimée avec succès.');
    }




public function searchTitre(Request $request)
{
    // Récupère la saisie de recherche de l'utilisateur
    $searchTerm = $request->input('search');

    // Recherche des événements dont le titre contient la saisie
    $events = Event::query()
    ->where('titre', 'LIKE', "%{$searchTerm}%")
    ->paginate(10); // Assurez-vous d'ajuster le nombre par page selon vos besoins


    // Retourne la vue avec les résultats de la recherche
    return view('Event', compact('events'));
}





}
