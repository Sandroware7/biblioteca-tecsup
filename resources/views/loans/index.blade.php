<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Préstamos Activos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Libros actualmente prestados</h3>
                        <a href="{{ route('books.index') }}" class="text-sm text-blue-600 hover:underline">Ir a libros &rarr;</a>
                    </div>

                    @if($loans->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                            <p class="font-bold">Todo en orden</p>
                            <p>No hay libros prestados pendientes de devolución en este momento.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg border border-gray-200">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Libro</th>
                                    <th scope="col" class="px-6 py-3">Usuario (Alumno)</th>
                                    <th scope="col" class="px-6 py-3 text-center">Fecha Préstamo</th>
                                    <th scope="col" class="px-6 py-3 text-center">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $loan)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $loan->book->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-800">{{ $loan->user->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $loan->user->email }}</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-500">
                                                    {{ $loan->loan_date }}
                                                </span>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <form action="{{ route('loans.return', $loan) }}" method="POST" onsubmit="return confirm('¿Confirmar que el libro {{ $loan->book->title }} ha sido devuelto?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 focus:outline-none transition ease-in-out duration-150 shadow-md">
                                                    Marcar Devuelto
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
