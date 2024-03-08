<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
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



    $nameevent = $event->titre;
    $nameeventdescription = $event->description;
    $nameeventlieux = $event->lieux;
    $nameeventcategory = $event->categorie->name; 
        $nameeventdate = $event->date;
        $imageUrl = $event->getFirstMediaUrl('eventImages');
    $data = [
        "titre" => $nameevent,
        "description" => $nameeventdescription,
        "lieux" => $nameeventlieux,
        "categorie" => $nameeventcategory,
        "date" => $nameeventdate,
        "image_url" => $imageUrl,
    ];
    

    if ($request->input('auto') == '1') {
        $pdf = Pdf::loadView('Ticket.Ticket', $data);
        return $pdf->download('invoice.pdf');
    } else {
        return back()->with('success', 'Votre réservation a été enregistrée. Veuillez attendre l\'acceptation de l\'Organisateur.');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        
        return view('Reservations.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $Reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $Reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $Reservation)
    {
        //
    }
}
