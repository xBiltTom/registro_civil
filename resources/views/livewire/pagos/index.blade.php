<div>
    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Pagos recibidos
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran todos los pagos recibidos por actas aceptadas</p>
                </div>
                <div>
                    <a href="{{route('personas.create')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar persona</button></a>
                </div>
            </div>

        </div>

        {{-- <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
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
        </div> --}}

        <div class="overflow-auto" style="max-height: 340px;">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @if($pagos->count())
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Solicitud
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Monto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nro de voucher
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pagante
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Accion</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$pago->solicitud->id}}
                        </th>
                        <td class="px-6 py-4">
                           S/. {{$pago->monto}}
                        </td>
                        <td class="px-6 py-4">
                            {{$pago->fecha_voucher}}
                        </td>
                        <td class="px-6 py-4">
                            {{$pago->numero}}
                        </td>
                        <td class="px-6 py-4">
                            {{$pago->solicitud->user->persona->nombre}} {{$pago->solicitud->user->persona->apellido}}
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-4 items-center">
                            <button
                                wire:click="abrirModalVoucher({{ $pago->id }})"
                                class="text-blue-600 hover:text-blue-800 focus:outline-none flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Ver voucher
                            </button>
                            <!-- Modal para visualizar voucher -->
                            <div
                            x-data="{ show: @entangle('mostrarModalVoucher') }"
                            x-show="show"
                            x-transition:enter="transition ease-out duration-300"
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
                                                Voucher de pago #{{ $pagoSeleccionado ? $pagoSeleccionado->id : '' }}
                                            </h3>
                                            <button wire:click="cerrarModalVoucher" class="text-gray-400 hover:text-gray-500">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        @if($pagoSeleccionado && $pagoSeleccionado->ruta_voucher)
                                            <div class="flex flex-col items-center">
                                                <div class="mb-4 text-center">
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Voucher #{{ $pagoSeleccionado->numero }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Fecha: {{ $pagoSeleccionado->fecha_voucher }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Monto: S/. {{ $pagoSeleccionado->monto }}</p>
                                                </div>

                                                <div class="bg-gray-100 dark:bg-gray-700 p-2 rounded-lg w-full">
                                                    <img
                                                        src="{{ asset('storage/'.$pagoSeleccionado->ruta_voucher) }}"
                                                        alt="Voucher de pago"
                                                        class="w-full h-auto object-contain rounded-md max-h-96"
                                                    >
                                                </div>

                                                <div class="mt-4">
                                                    <a
                                                        href="{{asset('storage/'.$pagoSeleccionado->ruta_voucher) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                        </svg>
                                                        Descargar voucher
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center justify-center p-6 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                <span class="text-gray-500 dark:text-gray-400">No se encontró el voucher para este pago</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end">
                                        <button
                                            wire:click="cerrarModalVoucher"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:border-gray-500 dark:hover:bg-gray-500"
                                        >
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
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
        {{ $pagos->links() }}
    </div>
</div>
