<div>
    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Solicitudes de los usuarios
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran las solicitudes a atender</p>
                </div>

                <div>
                    <button
                        type="button"
                        wire:click="abrirModalPeriodo"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Monto de pago
                </button>

<!-- Agregar el modal al final del archivo, antes de cerrar el div principal -->
<!-- Modal para configurar periodo de pago -->
                    <div
                        x-data="{ show: @entangle('mostrarModalPeriodo') }"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 overflow-y-auto"
                        style="display: none;"
                    >
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex justify-between items-start pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                            {{ $periodoSeleccionado ? 'Editar periodo de pago' : 'Nuevo periodo de pago' }}
                                        </h3>
                                        <button type="button" wire:click="cerrarModalPeriodo" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <!-- Formulario -->
                                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                            <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-3">Configuración del periodo</h4>

                                            <div class="mb-4">
                                                <label for="fechaInicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de inicio</label>
                                                <input
                                                    type="date"
                                                    wire:model="fechaInicio"
                                                    id="fechaInicio"
                                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                >
                                                @error('fechaInicio')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="fechaFin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de fin</label>
                                                <input
                                                    type="date"
                                                    wire:model="fechaFin"
                                                    id="fechaFin"
                                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                >
                                                @error('fechaFin')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="monto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Monto (S/.)</label>
                                                <input
                                                    type="number"
                                                    wire:model="monto"
                                                    id="monto"
                                                    step="0.01"
                                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                    placeholder="0.00"
                                                >
                                                @error('monto')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mt-4">
                                                <button
                                                    type="button"
                                                    wire:click="guardarPeriodo"
                                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                >
                                                    {{ $periodoSeleccionado ? 'Actualizar periodo' : 'Guardar periodo' }}
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Lista de periodos existentes -->
                                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                            <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-3">Periodos configurados</h4>

                                            <div class="overflow-y-auto max-h-60">
                                                @if(count($periodos) > 0)
                                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        @foreach($periodos as $periodo)
                                                            <li class="py-3 flex justify-between items-center {{ $periodo->estado == 1 ? 'bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 pl-2' : '' }}">
                                                                <div>
                                                                    <p class="text-sm font-medium text-gray-900 dark:text-white flex items-center">
                                                                        {{ \Carbon\Carbon::parse($periodo->inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($periodo->fin)->format('d/m/Y') }}
                                                                        @if($periodo->estado == 1)
                                                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                                                Actual
                                                                            </span>
                                                                        @endif
                                                                    </p>
                                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                                        S/. {{ number_format($periodo->monto, 2) }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex space-x-2">
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            type="checkbox"
                                                                            id="periodo-activo-{{ $periodo->id }}"
                                                                            wire:click="activarPeriodo({{ $periodo->id }})"
                                                                            {{ $periodo->estado == 1 ? 'checked' : '' }}
                                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                                            {{ $periodo->estado == 1 ? 'disabled' : '' }}
                                                                        >
                                                                        <label for="periodo-activo-{{ $periodo->id }}" class="ms-1 text-xs font-medium text-gray-700 dark:text-gray-400 {{ $periodo->estado == 1 ? 'text-green-600 dark:text-green-400' : '' }}">
                                                                            {{ $periodo->estado == 1 ? 'Activo' : 'Activar' }}
                                                                        </label>
                                                                    </div>
                                                                    <button
                                                                        type="button"
                                                                        wire:click="seleccionarPeriodo({{ $periodo->id }})"
                                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                                                    >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <div class="text-center py-4">
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">No hay periodos configurados</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @script
                    <script>
                        document.addEventListener('livewire:initialized', function () {
                            @this.on('mostrarMensaje', (data) => {
                                Swal.fire({
                                    icon: data.tipo,
                                    title: "Actualizando el monto de pago",
                                    text: data.mensaje,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                        });
                    </script>

                    @endscript --}}
                    <a href="{{route('solicitudes.general')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Atendidas</button></a>
                        <a href="{{route('solicitudes.historial')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Historial</button></a>
                </div>
            </div>

        </div>



        <div class="overflow-auto" style="max-height: 340px;">
            <table wire:poll.2s class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if($solicitudes->count())
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            N° de acta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo de acta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de solicitud
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Solicitante
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $solicitud )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$solicitud->acta->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$solicitud->acta->tipo->descripcion}}
                        </td>
                        <td class="px-6 py-4">
                            {{$solicitud->created_at->format('d/m/Y H:i')}}
                        </td>
                        <td class="px-6 py-4">
                            {{$solicitud->user->persona->nombre}} {{$solicitud->user->persona->apellido}}
                        </td>
                        <td class="px-6 py-4 text-left">
                            <a wire:navigate href="{{route('solicitudes.atender',["id"=>$solicitud->id])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Atender</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                    <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <div>
                                No se encontraron solicitudes
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Prueba a refrescar la página</p>
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
