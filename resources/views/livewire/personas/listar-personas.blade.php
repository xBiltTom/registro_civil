<div>
    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Pobladores de Chicama
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran todos los pobladores censados actualmente</p>
                </div>
                <div>
                    <a href="{{route('personas.create')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar persona</button></a>
                </div>
            </div>

        </div>

        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between items-center w-full">
                <label for="buscarPersona" class="w-1/3">
                    <h2>Buscar persona</h2>
                </label>
                <div class="relative w-2/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="buscado" wire:keydown="reiniciar" type="search" id="buscarPersona" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                </div>
            </div>
        </div>

        <div class="overflow-auto" style="max-height: 340px;">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if($personas->count())
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            DNI
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Apellido
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sexo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado Civil
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Accion</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$persona->dni}}
                        </th>
                        <td class="px-6 py-4">
                            {{$persona->nombre}}
                        </td>
                        <td class="px-6 py-4">
                            {{$persona->apellido}}
                        </td>
                        <td class="px-6 py-4">
                            ({{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años)
                        </td>
                        <td class="px-6 py-4">
                            {{$persona->sexo === 'F' ? 'Femenino' : 'Masculino'}}
                        </td>
                        <td class="px-6 py-4">
                            {{$persona->estado_civil  === 'C' ? 'Casado' : 'Soltero' }}
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-4 items-center">
                            <a href="{{ route('personas.edit', $persona->id) }}">
                                <button class="text-blue-600 hover:underline mr-2">Editar</button>
                            </a>
                            <div x-data="{ showAlert: false }" class="relative">
                                {{--
                            <button type="button" @click="showAlert = true" class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer"> Eliminar </button>
                                <!-- Modal de confirmación -->
                                
                                <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                                        <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro?</h2>
                                        <p class="text-gray-600 mt-2">No podrás revertir esta acción.</p>
                                        <div class="mt-4 flex justify-end space-x-2">
                                            <button type="button" @click="showAlert = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md"> Cancelar </button>
                                            <form wire:submit.prevent="borrar({{$persona->id}})">
                                                <button type="submit" @click="showAlert = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md"> Confirmar </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                --}}
                            </div>
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
        {{ $personas->links() }}
    </div>
</div>
