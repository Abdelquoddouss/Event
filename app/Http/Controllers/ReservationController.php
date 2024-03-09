<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{

   
    public function index()
    {
        // Récupération des événements ajoutés manuellement ayant au moins une réservation
        $events = Event::where('auto', 0) // Filtrer pour inclure uniquement les événements ajoutés manuellement
                       ->whereHas('reservations') // Assurez-vous qu'il y a au moins une réservation
                       ->with('reservations.user') // Précharger les réservations et les utilisateurs associés
                       ->get();
    
        // Retourner la vue avec les événements filtrés
        return view('organisateur.Reservation', compact('events'));
    }
    
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required|integer|exists:events,id',
        'user_id' => 'required|integer|exists:users,id',
        // Assurez-vous que 'status' est géré correctement selon votre logique d'application.
    ]);

    $reservation = new Reservation($request->all());
    $reservation->save();

    return redirect()->route('reservations.show', $reservation->id)
                     ->with('success', 'Réservation créée avec succès.');
}



public function reserver(Request $request, $id) 
{
    $event = Event::findOrFail($id);

    // Création et sauvegarde de la réservation
    $reservation = new Reservation();
    $reservation->event_id = $id;
    $reservation->user_id = auth()->id(); 
    $reservation->status = Reservation::STATUS_PENDING;
    $reservation->save();

    // Préparation des données pour le ticket PDF ou le message de succès
    $data = [
        "titre" => $event->titre,
        "description" => $event->description,
        "lieux" => $event->lieux,
        "categorie" => $event->categorie->name,
        "date" => $event->date,
        "image_url" => $event->getFirstMediaUrl('eventImages'),
    ];

    if ($request->input('auto') == '1') {
        $pdf = Pdf::loadView('Ticket.Ticket', $data);
        return $pdf->download('ticket.pdf');
    } else {
        return back()->with('success', 'Votre réservation a été enregistrée. Veuillez attendre l\'acceptation de l\'Organisateur.');
    }
}


    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        
        return view('Reservations.show', compact('event'));
    }


    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $newStatus = $request->input('status');
    
        switch ($newStatus) {
            case 'accepted':
                $reservation->status = Reservation::STATUS_ACCEPTED;
                $message = 'Vous avez accepté la réservation de ' . $reservation->user->name . '.';
                break;
            case 'refused':
                $reservation->status = Reservation::STATUS_REFUSED;
                $message = 'Vous avez refusé la réservation de ' . $reservation->user->name . '.';
                break;
            default:
                return back()->with('error', 'Action inconnue.');
        }
    
        $reservation->save();
    
        return back()->with('success', $message);
    }
    

    
}
