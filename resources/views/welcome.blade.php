<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google" content="notranslate">

    <title>Catálogo - Biblioteca Tecsup</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        }
    </script>
</head>
<body class="antialiased font-sans text-gray-900"
      style="background-color: #9fb0be;
             min-height: 100vh;
             display: flex;
             flex-direction: column;">
<nav class="border-b border-gray-200 sticky top-0 z-50" style="background-color: #263142;">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <span class="text-lg font-bold text-white tracking-tight">Biblioteca Tecsup</span>
            </div>

            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('books.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition border border-blue-400/30 px-3 py-1 rounded">
                                Gestión Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-emerald-400 hover:text-emerald-300 transition border border-emerald-400/30 px-3 py-1 rounded">
                                Mi Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white transition">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition shadow-sm">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-700 mb-3">
            Catálogo de Libros
        </h1>
        <p class="text-base text-gray-850 mb-8 max-w-xl mx-auto">
            Consulta la disponibilidad física de material bibliográfico en tiempo real.
        </p>

        <form action="{{ route('home') }}" method="GET" class="max-w-xl mx-auto flex gap-2">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full pl-9 px-4 py-2 bg-whitborder border-gray-700 rounded-md text-sm text-white placeholder-gray-500 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                       placeholder="Buscar por título, autor o año...">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-md shadow transition">
                Buscar
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($books as $book)
            <div class="bg-gray-800 rounded-lg shadow border border-gray-700 overflow-hidden flex flex-col hover:border-gray-600 transition duration-200">

                <div class="p-5 flex-grow">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="text-lg font-semibold text-gray-100 leading-snug">
                            {{ $book->title }}
                        </h3>
                        <span class="text-xs font-mono bg-gray-700 text-gray-300 px-1.5 py-0.5 rounded border border-gray-600 whitespace-nowrap">
                                {{ $book->year }}
                            </span>
                    </div>
                    <div class="flex items-center text-gray-400 text-sm">
                        <svg class="w-3.5 h-3.5 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $book->author }}
                    </div>
                </div>

                <div class="bg-gray-800/80 px-5 py-3 border-t border-gray-700 flex justify-between items-center">
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Disponibilidad</span>

                    @if($book->available > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-900/50 text-green-400 border border-green-800/50" title="Puedes venir a recogerlo">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full animate-pulse"></span>
                                En estantería: {{ $book->available }}
                            </span>

                    @elseif($book->stock > 0 && $book->available == 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-900/50 text-orange-400 border border-orange-800/50" title="Todas las copias están prestadas">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-orange-400 rounded-full"></span>
                                Todos Prestados
                            </span>

                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-900/50 text-red-400 border border-red-800/50">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                No Disponible
                            </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-gray-800/50 rounded-lg border border-dashed border-gray-700">
                <svg class="mx-auto h-10 w-10 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h3 class="text-base font-medium text-gray-300">No se encontraron libros</h3>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $books->links() }}
    </div>
</div>

<footer class="border-t py-4 text-center text-xs"
        style="background-color: #263141;
               border-color: #e5e7eb;
               color: #fdfdfd;
               width: 100%;
               margin-top: auto;"> &copy; {{ date('Y') }} Biblioteca Tecsup - Grupo 03.

</footer>
</body>
</html>
