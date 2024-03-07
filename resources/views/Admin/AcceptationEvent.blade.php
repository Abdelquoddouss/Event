@extends('master')
@section('content')

    
    <div class="px-4 py-6 sm:px-0">
    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
        <p class="text-2xl font-semibold pb-4 flex items-center justify-start">
            <i class="fas fa-list mr-3 text-blue-500"></i> Les Events
        </p>
        <div class=" relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">ID</th>   
                        <th scope="col" class="py-3 px-6">Image</th>
                        <th scope="col" class="py-3 px-6">Titre</th>
                        <th scope="col" class="py-3 px-6">Description</th>
                        <th scope="col" class="py-3 px-6">Lieu</th>
                        <th scope="col" class="py-3 px-6">Place</th>
                        <th scope="col" class="py-3 px-6">Date</th>
                        <th scope="col" class="py-3 px-6">Catégorie</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $event->id }}</th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"><img class="w-16 h-16 object-cover rounded-full border-2 border-gray-300" src="{{ $event->getFirstMediaUrl('eventImage') }}" alt="Event Image"></td>
                        <td class="py-4 px-6">{{ $event->titre }}</td>
                        <td class="py-4 px-6">{{ $event->description }}</td>
                        <td class="py-4 px-6">{{ $event->lieux }}</td>
                        <td class="py-4 px-6">{{ $event->place }}</td>
                        <td class="py-4 px-6">{{ $event->date }}</td>
                        <td class="py-4 px-6">{{ $event->categorie->name }}</td>
                        <td class="py-4 px-6">
                        @if($event->status == \App\Models\Event::STATUS_ACCEPTED)
                            <span class="text-green-600">Accepté</span>
                            <a href="{{ route('AdminEvent.reject', $event->id) }}" class="ml-4 inline-block px-6 py-2 border-2 border-red-600 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-red-100 hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Refuser</a>
                        @elseif($event->status == \App\Models\Event::STATUS_REJECTED)
                            <span class="text-red-600">Refusé</span>
                            <a href="{{ route('AdminEvent.accept', $event->id) }}" class="ml-4 inline-block px-6 py-2 border-2 border-green-600 text-green-600 font-medium text-xs leading-tight uppercase rounded hover:bg-green-100 hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Accepter</a>
                        @else
                            <span class="text-yellow-500">En attente</span>
                            <a href="{{ route('AdminEvent.accept', $event->id) }}" class="ml-4 inline-block px-6 py-2 border-2 border-green-600 text-green-600 font-medium text-xs leading-tight uppercase rounded hover:bg-green-100 hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Accepter</a>
                            <a href="{{ route('AdminEvent.reject', $event->id) }}" class="ml-4 inline-block px-6 py-2 border-2 border-red-600 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-red-100 hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Refuser</a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
