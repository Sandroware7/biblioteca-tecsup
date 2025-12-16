<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::user()->role === 'admin')
                {{ __('Panel de Control - Administración') }}
            @else
                {{ __('Mi Historial de Biblioteca') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- vista para personal administrativp -->
            @if(Auth::user()->role === 'admin')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500 flex flex-col justify-between">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Catálogo Total</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-3xl font-extrabold text-gray-900">{{ $total_books }}</span>
                            <span class="ml-2 text-sm text-gray-500">libros</span>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500 flex flex-col justify-between">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Préstamos Activos</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-3xl font-extrabold text-gray-900">{{ $active_loans }}</span>
                            <span class="ml-2 text-sm text-gray-500">pendientes</span>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-emerald-500 flex flex-col justify-between">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Estudiantes</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-3xl font-extrabold text-gray-900">{{ $total_users }}</span>
                            <span class="ml-2 text-sm text-gray-500">usuarios</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-white">
                        <h3 class="font-bold text-lg text-gray-800">Actividad Reciente</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider border-r border-gray-300">Libro</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider border-r border-gray-300">Usuario</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider">Estado</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recent_loans as $loan)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loan->book->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loan->user->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        @if($loan->return_date)
                                            <span class="font-bold text-sm" style="color: #217c06;">
                        Devuelto
                    </span>
                                        @else
                                            <span class="font-bold text-sm" style="color: #8f2506;">
                        Prestado
                    </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            <!-- vista para estudiantes  -->
            @else

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-400">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Pendientes de Devolución</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">
                            {{ $my_loans->whereNull('return_date')->count() }}
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Libros Leídos</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">
                            {{ $my_loans->whereNotNull('return_date')->count() }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Detalle de Préstamos</h3>
                        @if($my_loans->isEmpty())
                            <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="mt-2 text-gray-500">Aún no tienes historial de préstamos.</p>
                                <a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-2 inline-block">¡Busca un libro en el catálogo!</a>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                    <tr>
                                        <th class="px-6 py-3">Libro</th>
                                        <th class="px-6 py-3 text-center">Fecha Préstamo</th>
                                        <th class="px-6 py-3 text-center">Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($my_loans as $loan)
                                        <tr class="bg-white border-b hover:bg-gray-50 transition duration-150">
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $loan->book->title }} <br>
                                                <span class="text-xs text-gray-400 font-normal">{{ $loan->book->author }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-center text-gray-600">
                                                {{ $loan->loan_date }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($loan->return_date)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm" style="background-color: #488a03;">
                                                            Devuelto
                                                        </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm animate-pulse" style="background-color: #b31f02;">
                                                            En tu poder
                                                        </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>
