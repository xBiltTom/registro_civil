<div>
    <div>
        <a href="{{route('actas.ver',['id'=>$acta->id])}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Volver</button></a>
    </div>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit="registrarSolicitud" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Solicitar acta</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="acta" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">N° de Acta</label>
                    <input disabled  value="{{$acta->id}}" type="text" id="acta" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Tipo</label>
                    <input disabled value="{{$acta->tipo->descripcion}}" type="text" id="libro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
            </div>

            <div>
                <label for="fecha_registro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Registro</label>

                <input disabled value="{{$acta->fecha_registro}}" type="date" id="fecha_registro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>

            </div>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Detalles del pago</h2>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">
                <p>Detalles del pago</p>
                <p>Costo a fecha de hoy S/. {{$valorpago->monto}}</p>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="numero_voucher">Numero del voucher</label>
                    <input maxlength="8" wire:model="numero_voucher" name="numero_voucher" id="numero_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">
                    @error('numero_voucher')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label class="text-white block mb-1" for="fecha_voucher">Fecha del voucher</label>
                    <input wire:model="fecha_voucher" name="fecha_voucher" id="fecha_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="date">
                    @error('fecha_voucher')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <div
                    x-data="{ uploading: false, progress: 0, showModal: false, fileReady: false }"
                    x-init="$watch('uploading', value => {
                        if (!value) fileReady = true;
                    })"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <label class="block text-gray-200 font-medium mb-1" for="ruta_voucher">Subir voucher</label>

                    <!-- Contenedor dinámico que se adapta a 1 o 2 columnas -->
                    <div :class="fileReady ? 'grid grid-cols-2 gap-4 items-center' : 'block'" class="transition-all duration-300">

                        <!-- Input archivo -->
                        <input
                            wire:model="ruta_voucher"
                            name="ruta_voucher"
                            id="ruta_voucher"
                            type="file"
                            class="block w-full text-sm text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                bg-gray-800 border border-gray-700 rounded-md px-5 py-2"
                        />
                        @error('ruta_voucher')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <!-- Botón visible solo al terminar carga -->
                        <div x-show="fileReady" x-transition>
                            <button
                                type="button"
                                @click="showModal = true"
                                class="flex w-full justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.5 0a6.5 6.5 0 0113 0 6.5 6.5 0 01-13 0z"/>
                                </svg>
                                Ver voucher
                            </button>
                        </div>
                    </div>

                    <!-- Barra de progreso -->
                    <div x-show="uploading" class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-4 overflow-hidden">
                            <div
                                class="bg-blue-600 h-full rounded-full transition-all duration-300 ease-in-out"
                                :style="{ width: progress + '%' }"
                            ></div>
                        </div>
                        <p class="mt-1 text-sm text-gray-300 text-right" x-text="progress + '%'"></p>
                    </div>

                    <!-- Modal -->
                    <div
                        x-show="showModal"
                        x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                    >
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl max-w-lg w-full relative">
                            <button
                                type="button"
                                @click="showModal = false"
                                class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl"
                            >
                                &times;
                            </button>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Voucher cargado</h2>
                            <img
                                src="{{ $ruta_voucher?->temporaryUrl() }}"
                                alt="Voucher"
                                class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                            >
                        </div>
                    </div>
                </div>
            </div>




            <div class="mt-6 flex justify-between">

                {{-- <a href="{{route('defunciones-pdf',['id'=>$id_acta])}}">
                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Descargar acta
                    </button>
                </a> --}}

                <div x-data="{ showAlert: false }">
                    <!-- Botón para disparar la alerta -->
                    <button type="button" @click="showAlert = true" class="bg-yellow-400 hover:bg-yellow-700 text-black rounded-md px-6 py-2 transition-all duration-200">
                        Enviar solicitud
                    </button>

                    <!-- Alerta -->
                    <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                            <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro de enviar esta solicitud?</h2>
                            <p class="text-gray-600 mt-2">No podrás revertir esta acción.</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" @click="showAlert = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                    Cancelar
                                </button>
                                <button type="submit @click="showAlert = false; alert('¡Acción confirmada!')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                    Confirmar
                                </button >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>


