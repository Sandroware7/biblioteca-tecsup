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
                                <div class="text-gray-600 mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-semibold text-sm text-gray-950">¡Hecho!</p> <p class="text-sm text-gray-800">{{ session('success') }}</p> </div>
                            </div>

                            <button @click="show = false" class="text-gray-500 hover:text-gray-950 transition-colors duration-150 ease-in-out p-1 rounded-full hover:bg-lime-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-700">Listado de Libros</h3>
                        <a href="{{ route('books.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm transition duration-150 ease-in-out">
                            + Nuevo Libro
                        </a>
                    </div>

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg border border-gray-200">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3">Título</th>
                                <th scope="col" class="px-6 py-3">Autor</th>
                                <th scope="col" class="px-6 py-3">Año</th>
                                <th scope="col" class="px-6 py-3 text-center">Stock</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $book)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $book->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->author }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->year }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center space-x-8">
                                            <a href="{{ route('books.edit', $book) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                                Editar
                                            </a>

                                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este libro?');">
                                                @csrf
                                                @method('DELETE') <button type="submit" class="font-medium text-red-600 hover:text-red-800 hover:underline bg-transparent border-none cursor-pointer">
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
