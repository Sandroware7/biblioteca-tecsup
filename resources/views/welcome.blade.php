<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="bg-gray-900 text-gray-300 antialiased font-sans">

<nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <span class="text-xl">📚</span>
                <span class="text-lg font-bold text-white tracking-tight">Biblioteca Tecsup</span>
            </div>

            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('books.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition">
                            Ir a Gestión →
                        </a>
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
        <h1 class="text-3xl font-bold text-white mb-3">
            Catálogo de Libros
        </h1>
        <p class="text-base text-gray-400 mb-8 max-w-xl mx-auto">
            Consulta la disponibilidad de material bibliográfico en tiempo real.
        </p>

        <form action="{{ route('home') }}" method="GET" class="max-w-xl mx-auto flex gap-2">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full pl-9 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-sm text-white placeholder-gray-500 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
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
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Estado</span>

                    @if($book->stock > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-900/50 text-green-400 border border-green-800/50">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full"></span>
                                Disponible ({{ $book->stock }})
                            </span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-900/50 text-red-400 border border-red-800/50">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                Agotado
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

<footer class="border-t border-gray-800 mt-12 py-6 text-center text-gray-600 text-xs">
    &copy; {{ date('Y') }} Biblioteca Tecsup.
</footer>

</body>
</html>
