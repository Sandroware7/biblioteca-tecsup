<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Nuevo Libro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('books.store') }}" method="POST" class="max-w-lg mx-auto">
                        @csrf <div class="mb-5">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Título del Libro</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ej: El Quijote" required>
                        </div>

                        <div class="mb-5">
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-900">Autor</label>
                            <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-5">
                                <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Año</label>
                                <input type="number" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>

                            <div class="mb-5">
                                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock (Cantidad)</label>
                                <input type="number" name="stock" id="stock" value="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6 gap-4">
                            <a href="{{ route('books.index') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm whitespace-nowrap transition-colors duration-200">
                                &larr; Volver al listado
                            </a>

                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition-all duration-200">
                                Guardar Libro
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
