<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Models\Categorie;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('Organisateur.AfficherEvent', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $categories = Categorie::all();


        return view('Organisateur.CreateEvent', compact('events','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvent $request)
    {
       
        $event = Event::create($request->all());  
        
        if($request->has("event_image")){
            $event->addMediaFromRequest("event_image")->toMediaCollection("eventImage");
        }


        return redirect()->route('Event.index')->with('success', 'Événement ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Categorie::all();
        return view('Organisateur.EditeEvente', compact('event','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $events = Event::find($id);
        $events->update($request->all());
        return redirect()->route('Event.index')->with('success', 'Project mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();

    return redirect()->route('Event.index')->with('success', 'Event supprimée avec succès.');
    }
}
