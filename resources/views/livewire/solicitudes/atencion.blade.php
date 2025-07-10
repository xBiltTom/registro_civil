<div>
    <div>
        <a href="{{route('solicitudes')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Volver</button></a>
    </div>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit="registrarSolicitud" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Atendiendo</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="acta" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">N° de Acta</label>
                    <input disabled  value="{{$solicitud->acta_id}}" type="text" id="acta" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Tipo</label>
                    <input disabled value="{{$solicitud->acta->tipo->descripcion}}" type="text" id="libro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
            </div>

            <div>
                <label for="fecha_registro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de la solicitud</label>

                <input readonly value="{{$solicitud->created_at->format('d/m/Y H:i')}}" type="text" id="fecha_registro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>

            </div>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Detalles del solicitante</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="nombres_solicitante">Nombres</label>
                    <input readonly value="{{$solicitud->user->persona->nombre}} {{$solicitud->user->persona->apellido}}"  name="nombres_solicitante" id="nombres_solicitante" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
                <div class="">
                    <label class="text-white block mb-1" for="solicitante_direccion">Direccion</label>
                    <input readonly value="{{$solicitud->user->persona->lugar->distrito}},{{$solicitud->user->persona->lugar->provincia}},{{$solicitud->user->persona->lugar->departamento}}" name="solicitante_direccion" id="solicitante_direccion" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="correo">Correo</label>
                    <input readonly value="{{$solicitud->user->email}}" name="solicitante_direccion" id="solicitante_direccion" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
                <div class="">
                    <label class="text-white block mb-1" for="solicitante_direccion">Telefono</label>
                    <input readonly value="{{$solicitud->user->persona->telefono}}"  name="correo" id="nombres_solicitante" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="email">
                </div>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Detalles del pago</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="numero_voucher">Numero del voucher</label>
                    <input readonly maxlength="8" wire:model="numero_voucher" name="numero_voucher" id="numero_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
                <div class="">
                    <label class="text-white block mb-1" for="fecha_voucher">Fecha del voucher</label>
                    <input readonly wire:model="fecha_voucher" name="fecha_voucher" id="fecha_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="date">

                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="monto">Monto a verificar (Soles)</label>
                    <label class="text-white block mb-1" for="monto">Monto a verificar (soles)</label>
                    <input readonly maxlength="8" wire:model="monto" name="monto" id="monto" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
                <div class="">
                    <label class="text-white block mb-1" for="">Voucher cargado</label>
                    <div x-data="{ showModal: false }" class="">
                        @if($ruta_voucher)
                            <button
                                type="button"
                                @click="showModal = true"
                                class="flex items-center justify-center w-full gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-200 font-medium"
                            >
                                <!-- Ícono SVG (Ojo / Ver) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.5 0a6.5 6.5 0 0113 0 6.5 6.5 0 01-13 0z" />
                                </svg>
                                Ver voucher
                            </button>

                            <!-- Modal -->
                            <div
                                x-show="showModal"
                                x-transition
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                            >
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl max-w-lg w-full relative">
                                    <!-- Botón cerrar -->
                                    <button
                                        type="button"
                                        @click="showModal = false"
                                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl"
                                    >
                                        &times;
                                    </button>
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Voucher cargado</h2>
                                    <img
                                        src="{{ asset('storage/'.$ruta_voucher) }}"
                                        alt="Voucher"
                                        class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                                    >
                                    <!-- Botón de descarga -->
                                    <a
                                    href="{{ asset('storage/'.$ruta_voucher) }}"
                                    download
                                    class="mt-4 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition duration-200"
                                    >
                                    <!-- Ícono de descarga -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                                    </svg>
                                    Descargar voucher
                                    </a>

                                </div>
                            </div>
                        @else
                            <span class="text-red-400">El voucher no se subió correctamente</span>
                        @endif
                    </div>



                </div>
            </div>





            <div class="mt-6 flex justify-between" x-data="{ showRechazo: false, showConfirmRechazo: false, showConfirmAceptar: false }">

                <!-- Botón RECHAZAR -->
                <button type="button" @click="showRechazo = true" class="bg-red-600 hover:bg-red-800 text-white rounded-md px-6 py-2 transition-all duration-200 w-full mr-2">
                    Rechazar
                </button>

                <!-- Modal de RECHAZO -->
                <div
                    x-show="showRechazo"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                >
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl w-full max-w-lg">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Motivo del rechazo</h2>
                    <textarea wire:model="motivo_rechazo" rows="4" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2"></textarea>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button @click="showRechazo = false" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                            Cancelar
                        </button>
                        <button @click="showConfirmRechazo = true" type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                            Aceptar
                        </button>
                    </div>
                </div>
                </div>

                <!-- Confirmación del rechazo -->
                <div
                    x-show="showConfirmRechazo"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50"
                >
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro de rechazar?</h2>
                    <p class="text-gray-600 mt-2">Esta acción no se puede deshacer.</p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button @click="showConfirmRechazo = false" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                            Cancelar
                        </button>
                        <button wire:click="rechazarSolicitud" type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                            Confirmar
                        </button>
                    </div>
                </div>
                </div>

                <!-- Confirmación de ACEPTAR -->


                <!-- Botón ACEPTAR -->
                <button type="button" @click="showConfirmAceptar = true" class="bg-green-600 hover:bg-green-800 text-white rounded-md px-6 py-2 transition-all duration-200 w-full ml-2">
                    Confirmar
                </button>

                <!-- Confirmación de aceptación -->
                <div
                    x-show="showConfirmAceptar"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50"
                >
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro de aceptar?</h2>
                    <p class="text-gray-600 mt-2">No podrás revertir esta acción.</p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="showConfirmAceptar = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                            Cancelar
                        </button>
                        <button wire:click="aceptarSolicitud" type="button" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                            Confirmar
                        </button>
                    </div>
                </div>
                </div>

            </div>


        </form>
    </div>

</div>


