@extends('Organisateur.dashbordOrg')
@section('content')



@if(session('success'))
    <div style="background-color: #ccffcc; color: #006600; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif


<div class="px-4 py-6 sm:px-0">
    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
        <p class="text-2xl font-semibold pb-4 flex items-center justify-start">
            <i class="fas fa-list mr-3 text-blue-500"></i> Les Events
        </p>
        <div class="relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">ID</th>
                        <th scope="col" class="py-3 px-6">Titre</th>
                        <th scope="col" class="py-3 px-6">Lieu</th>
                        <th scope="col" class="py-3 px-6">Date</th>
                        <th scope="col" class="py-3 px-6">User</th>
                        <th scope="col" class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
    @foreach($event->reservations as $reservation)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="py-4 px-6">{{ $event->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $event->titre }}</td>
            <td class="py-4 px-6">{{ $event->lieux }}</td>
            <td class="py-4 px-6">{{ $event->date }}</td>
            <td class="py-4 px-6">{{ $reservation->user->name }}</td>
            <td class="py-4 px-6">
                @if($reservation->status == \App\Models\Reservation::STATUS_PENDING)
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="text-green-600">Accepter</button>
                    </form>
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="refused">
                        <button type="submit" class="text-red-600">Refuser</button>
                    </form>
                @elseif($reservation->status == \App\Models\Reservation::STATUS_ACCEPTED)
                    <span class="text-green-600">Acceptée</span>
                @elseif($reservation->status == \App\Models\Reservation::STATUS_REFUSED)
                    <span class="text-red-600">Refusée</span>
                @endif
            </td>
        </tr>
    @endforeach
@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
