<div>
    {{-- <div class="p-2 bg-yellow-100 text-sm">
        Filtro activo:
        Estado: {{ $estadoSeleccionado }} |
        Búsqueda: {{ $buscado ?? 'Ninguna' }} |
        Resultados: {{ $solicitudes->total() }}
    </div> --}}

    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Solicitudes
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran tus solicitudes</p>
                </div>
                <div>
                    <select wire:model.live="estadoSeleccionado" id="estado" class="cursor-pointer block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all">Todos los estados</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between items-center w-full">
                <label for="buscarPersona" class="w-1/3">
                    <h2>Buscar solicitud</h2>
                </label>
                <div class="relative w-2/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="buscado" type="search" id="buscarActa" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por número de acta..." />
                </div>
            </div>
        </div>

        <div class="overflow-auto" style="max-height: 340px;">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if($solicitudes->count())
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            N° Solicitud
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Acción</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $solicitud)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $solicitud->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $solicitud->acta_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $solicitud->acta->tipo->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $solicitud->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($solicitud->estado->id == 1) bg-blue-100 text-blue-800
                                @elseif($solicitud->estado->id == 2) bg-green-100 text-green-800
                                @elseif($solicitud->estado->id == 3) bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $solicitud->estado->descripcion }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-4 items-center">
                            <a href="">
                                <button class="text-blue-600 hover:underline mr-2">Ver solicitud</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                    <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <div>
                                No se encontraron solicitudes
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    @if($estadoSeleccionado !== 'all' || $buscado)
                                        Prueba con otros criterios de búsqueda
                                    @else
                                        No tienes solicitudes registradas
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </table>
        </div>
    </div>

    <div class="mt-2">
        {{ $solicitudes->links() }}
    </div>
</div>
