<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(4);
        return view('Admin.AcceptationEvent', compact('events')); 
       }


       public function index2()
{
    // Récupère uniquement les événements avec le statut accepté
    $events = Event::where('status', Event::STATUS_ACCEPTED)->paginate(6);
    return view('Event', compact('events')); 
}



       public function accept($id)
       {
           $event = Event::findOrFail($id);
           // Utiliser la constante pour le statut accepté
           $event->update(['status' => Event::STATUS_ACCEPTED]);
           return back()->with('success', 'Événement accepté avec succès.');
       }
       
       public function reject($id)
       {
           $event = Event::findOrFail($id);
           // Utiliser la constante pour le statut refusé
           $event->update(['status' => Event::STATUS_REJECTED]);
           return back()->with('success', 'Événement refusé avec succès.');
       }
       

   
}
