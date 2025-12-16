<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Libros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                             class="flex justify-between items-center bg-lime-100 border border-lime-200 text-gray-800 p-4 mb-6 shadow-sm rounded-lg"
                             role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <div><p class="font-semibold text-sm">¡Hecho!</p> <p class="text-sm">{{ session('success') }}</p></div>
                            </div>
                            <button @click="show = false" class="text-gray-500 hover:text-gray-950"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"><svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></span>
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-xl font-bold text-gray-800 tracking-tight">Gestión de Biblioteca</h3>

                        <form action="{{ route('books.index') }}" method="GET" class="flex w-full md:max-w-md shadow-sm rounded-lg overflow-hidden">
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full px-4 py-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none text-gray-700" placeholder="Buscar título, autor o año..." >
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 font-medium flex items-center">Buscar</button>
                        </form>

                        <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm whitespace-nowrap">+ Nuevo Libro</a>
                    </div>

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg border border-gray-200">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3">Título</th>
                                <th scope="col" class="px-6 py-3">Autor</th>
                                <th scope="col" class="px-6 py-3 text-center" >Año</th>
                                <th scope="col" class="px-6 py-3 text-center">Disponibilidad / Stock</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $book)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $book->title }}</td>
                                    <td class="px-6 py-4">{{ $book->author }}</td>
                                    <td class="px-6 py-4 text-center">{{ $book->year }}</td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="{{ $book->available > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-bold px-2.5 py-0.5 rounded border border-gray-200">
                                            {{ $book->available }} / {{ $book->stock }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center gap-3">

                                            @if($book->available > 0)
                                                <a href="{{ route('loans.create', $book) }}" class="text-green-600 hover:text-green-800 font-bold hover:underline" title="Prestar Libro">
                                                    Prestar
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs italic cursor-not-allowed">Agotado</span>
                                            @endif

                                            <span class="text-gray-300">|</span>

                                            <a href="{{ route('books.edit', $book) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                                Editar
                                            </a>

                                            <span class="text-gray-300">|</span>

                                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este libro?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:text-red-800 hover:underline bg-transparent border-none cursor-pointer">
                                                    Borrar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
