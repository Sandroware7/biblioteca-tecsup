<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Préstamo') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 42px !important;
            border-color: #d1d5db !important;
            border-radius: 0.375rem !important;
            padding-top: 6px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('loans.store', $book) }}" method="POST" class="max-w-xl">
                        @csrf

                        <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Libro a prestar</h3>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500">Título:</span>
                                    <span class="font-semibold text-gray-800">{{ $book->title }}</span>
                                </div>
                                <div>
                                    <span class="block text-gray-500">Autor:</span>
                                    <span class="font-semibold text-gray-800">{{ $book->author }}</span>
                                </div>
                                <div class="col-span-2">
                                    <span class="block text-gray-500">Estado:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Stock Físico: {{ $book->available }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="user_id" class="block font-medium text-sm text-gray-700 mb-1">
                                Usuario Solicitante (Buscar por nombre)
                            </label>

                            <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="" disabled selected>-- Escribe para buscar... --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="loan_date" class="block font-medium text-sm text-gray-700 mb-1">
                                Fecha de Préstamo
                            </label>
                            <input type="date" name="loan_date" id="loan_date"
                                   value="{{ date('Y-m-d') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm transition ease-in-out duration-150">
                                Confirmar Préstamo
                            </button>

                            <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium underline">
                                Cancelar y volver
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#user_id').select2({
                placeholder: "Escribe el nombre del alumno...",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "No se encontraron usuarios";
                    }
                }
            });
        });
    </script>
</x-app-layout>
