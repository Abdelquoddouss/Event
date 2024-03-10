<header>
@vite(['resources/css/app.css', 'resources/js/app.js'])

    <nav x-data="{ isOpen: false }" class="bg-white shadow dark:bg-gray-900">
        <div class="container px-6 py-4 mx-auto">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex items-center justify-between">
                    <a href="#" class="mx-auto ">
                    <img class="w-16 h-16 sm:w-20 sm:h-20" src="/img/logo.webp" alt="">
                    </a>
                    <!-- Mobile menu button -->
                    <div class="flex lg:hidden">
                       <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                            </svg>
                    
                            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>  
                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white shadow-md lg:bg-transparent lg:dark:bg-transparent lg:shadow-none dark:bg-gray-900 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:w-auto lg:opacity-100 lg:translate-x-0">
                <div class="-mx-4 lg:flex lg:items-center">
                <a href="/welcome" class="block mx-4 text-gray-700 capitalize dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">HOME</a>
    <a href="/event" class="block mx-4 mt-4 text-gray-700 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">Events</a>
    <!-- Conditionally show links based on authentication status -->
    @if(Auth::check())
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block mx-4 mt-4 text-gray-700 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" class="block mx-4 mt-4 text-gray-700 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">Login</a>
        <a href="{{ route('register') }}" class="block mx-4 mt-4 text-gray-700 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">Register</a>
    @endif
</div>

                </div>
            </div>
        </div>
    </nav>
    <div class="w-full bg-center bg-cover h-[38rem]" style="background-image: url('/img/ev.jpg');">
        <div class="flex items-center justify-center w-full h-full bg-gray-900/40">
            <div class="text-center">
                <h1 class="text-3xl font-semibold text-white lg:text-4xl">Build your new <span class="text-blue-400">Saas</span> Project</h1>
                <button class="w-full px-5 py-2 mt-4 text-sm font-medium text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Start project</button>
            </div>
        </div>
    </div>
</header>


<!-- component -->
<div class="min-h-screen bg-gradient-to-tr from-red-300 to-yellow-200  py-20">
<div class="container mx-auto">
    <form action="{{ route('event.search') }}" method="GET">
        <input type="text" name="search" placeholder="Rechercher des événements..." class="px-4 py-2 border rounded-md" />
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md">Rechercher</button>
    </form>
</div>



    <div>
        <div class="md:px-4 container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0">
            @foreach ($events as $event)
            <div class=" bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
            <h3 class="mb-3 text-xl font-bold text-indigo-600">{{ $event->titre }}</h3>
            <div class="relative">
                <img class="w-full rounded-xl" src="{{ $event->getFirstMediaUrl('eventImage', 'thumb') }}" alt="Event Image" />
                <p class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">{{ $event->status === \App\Models\Event::STATUS_ACCEPTED ? 'Accepté' : '' }}</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">{{ Str::limit($event->description, 50) }}</h1>
            <div class="my-4">
                <div class="flex space-x-1 items-center">
                <span>
                    <!-- Icône ou information -->
                </span>
                <p>{{ $event->date }}</p>
                </div>
                <!-- Plus d'informations comme lieu, etc. -->
                <a href="{{ route('reservation.show', $event->id) }}" class="mt-4 text-xl w-full text-center block text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Détails</a>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="paginate-wrapper flex justify-center w-full mt-8">
        {{ $events->links() }}
    </div>
</div>

</div>








<footer class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto"> 
        <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700">

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Quick Link</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Home</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Who We Are</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Our Philosophy</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Industries</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Retail & E-Commerce</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Information Technology</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Finance & Insurance</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Services</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Translation</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Proofreading & Editing</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">Content Creation</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Contact Us</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">+880 768 473 4978</a>
                    <a href="#" class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:text-blue-500">info@merakiui.com</a>
                </div>
            </div>
        </div>
        
        <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700">
        
        <div class="flex flex-col items-center justify-between sm:flex-row">
            <a href="#">
            <img class="w-16 h-16 sm:w-20 sm:h-20" src="/img/logo.webp" alt="">
            </a>

            <p class="mt-4 text-sm text-gray-500 sm:mt-0 dark:text-gray-300">© Copyright 2021. All Rights Reserved.</p>
        </div>
    </div>
</footer>

