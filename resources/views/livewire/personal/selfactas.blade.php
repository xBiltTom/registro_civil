<div>
    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Tus actas
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran las actas de las que eres partícipe</p>
                </div>
                <div>
                    <select wire:model.live="tipoSeleccionado" id="tipo" class="cursor-pointer block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option class="cursor-pointer" value="all">Todas</option>
                        @foreach ($tipos as $tipo)
                            <option class="cursor-pointer" value="{{ $tipo->id }}">{{ $tipo->descripcion }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between items-center w-full">
                <label for="buscarPersona" class="w-1/3">
                    <h2>Buscar acta</h2>
                </label>
                <div class="relative w-2/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="buscado" wire:keydown="reiniciar" type="search" id="buscarPersona" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe el número del acta ..." />
                </div>
            </div>
        </div>

        <div class="overflow-auto" style="max-height: 340px;">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if($actas->count())
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            N° de acta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo de acta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de registro
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actas as $acta )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$acta->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$acta->tipo->descripcion}}
                        </td>
                        <td class="px-6 py-4">
                            {{$acta->fecha_registro}}
                        </td>
                        <td class="px-6 py-4 text-left">
                            <a wire:navigate href="{{route('actas.ver', ['id' => $acta->id])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                    <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <div>
                                No se encontraron coincidencias
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Prueba a realizar la búsqueda nuevamente</p>
                            </div>
                        </div>
                    </div>
                @endif
            </table>
        </div>
    </div>

    <div class="mt-2">
        {{ $actas->links() }}
    </div>
</div>
