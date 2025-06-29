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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label class="text-white block mb-1" for="numero_voucher">Numero del voucher</label>
                    <input maxlength="8" wire:model="numero_voucher" name="numero_voucher" id="numero_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="text">

                </div>
                <div class="">
                    <label class="text-white block mb-1" for="fecha_voucher">Fecha del voucher</label>
                    <input wire:model="fecha_voucher" name="fecha_voucher" id="fecha_voucher" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="date">

                </div>
            </div>

            <div class="mb-6">
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >

                    <label class="block text-gray-200 font-medium mb-1" for="ruta_voucher">Subir voucher</label>
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
                </div>
                @if($ruta_voucher)
                    <div class="mt-4">
                        <h3 class="text-gray-200 font-medium mb-2">Previsualización del voucher</h3>
                        <div class="rounded-lg overflow-hidden border-2 border-gray-600 bg-gray-900 shadow-md p-2 max-w-md">
                            <img
                                src="{{ $ruta_voucher->temporaryUrl() }}"
                                alt="Voucher cargado"
                                class="w-full h-auto object-contain rounded-md"
                            >
                        </div>
                    </div>
                @endif


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
                            <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro?</h2>
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


