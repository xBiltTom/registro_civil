<!-- filepath: /c:/Users/Usuario/Desktop/Laravel/Project_Git/registro-civil/resources/views/livewire/personal/verificacion/index.blade.php -->
<div>
    @if(session('error'))
        <script>
            /* document.addEventListener('DOMContentLoaded', function() { */
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#3085d6',
                });
            /* }); */
        </script>
    @endif

    @if(session('mensaje'))
        <script>
           /*  document.addEventListener('DOMContentLoaded', function() { */
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('mensaje') }}',
                    confirmButtonColor: '#3085d6',
                });
            /* }); */
        </script>
    @endif

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit="enviarVerificacion" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Verificación de identidad</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Para activar tu cuenta, necesitamos verificar tu identidad. Por favor sube las siguientes imágenes:</p>

            <!-- DNI Anverso -->
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
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1" for="dni_anverso">DNI Anverso (parte frontal)</label>

                    <!-- Contenedor dinámico que se adapta a 1 o 2 columnas -->
                    <div :class="fileReady ? 'grid grid-cols-2 gap-4 items-center' : 'block'" class="transition-all duration-300">

                        <!-- Input archivo -->
                        <input
                            wire:model="dni_anverso"
                            name="dni_anverso"
                            id="dni_anverso"
                            type="file"
                            accept="image/*"
                            class="block w-full text-sm text-gray-700 dark:text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md px-5 py-2"
                        />
                        @error('dni_anverso')
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
                                Ver imagen
                            </button>
                        </div>
                    </div>

                    <!-- Barra de progreso -->
                    <div x-show="uploading" class="mt-4">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                            <div
                                class="bg-blue-600 h-full rounded-full transition-all duration-300 ease-in-out"
                                :style="{ width: progress + '%' }"
                            ></div>
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 text-right" x-text="progress + '%'"></p>
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
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">DNI Anverso</h2>
                            <img
                                src="{{ $dni_anverso?->temporaryUrl() }}"
                                alt="DNI Anverso"
                                class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- DNI Reverso -->
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
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1" for="dni_reverso">DNI Reverso (parte trasera)</label>

                    <!-- Contenedor dinámico que se adapta a 1 o 2 columnas -->
                    <div :class="fileReady ? 'grid grid-cols-2 gap-4 items-center' : 'block'" class="transition-all duration-300">

                        <!-- Input archivo -->
                        <input
                            wire:model="dni_reverso"
                            name="dni_reverso"
                            id="dni_reverso"
                            type="file"
                            accept="image/*"
                            class="block w-full text-sm text-gray-700 dark:text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md px-5 py-2"
                        />
                        @error('dni_reverso')
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
                                Ver imagen
                            </button>
                        </div>
                    </div>

                    <!-- Barra de progreso -->
                    <div x-show="uploading" class="mt-4">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                            <div
                                class="bg-blue-600 h-full rounded-full transition-all duration-300 ease-in-out"
                                :style="{ width: progress + '%' }"
                            ></div>
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 text-right" x-text="progress + '%'"></p>
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
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">DNI Reverso</h2>
                            <img
                                src="{{ $dni_reverso?->temporaryUrl() }}"
                                alt="DNI Reverso"
                                class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto personal -->
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
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1" for="foto">Foto personal (selfie actual)</label>

                    <!-- Contenedor dinámico que se adapta a 1 o 2 columnas -->
                    <div :class="fileReady ? 'grid grid-cols-2 gap-4 items-center' : 'block'" class="transition-all duration-300">

                        <!-- Input archivo -->
                        <input
                            wire:model="foto"
                            name="foto"
                            id="foto"
                            type="file"
                            accept="image/*"
                            class="block w-full text-sm text-gray-700 dark:text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md px-5 py-2"
                        />
                        @error('foto')
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
                                Ver imagen
                            </button>
                        </div>
                    </div>

                    <!-- Barra de progreso -->
                    <div x-show="uploading" class="mt-4">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                            <div
                                class="bg-blue-600 h-full rounded-full transition-all duration-300 ease-in-out"
                                :style="{ width: progress + '%' }"
                            ></div>
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 text-right" x-text="progress + '%'"></p>
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
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Foto personal</h2>
                            <img
                                src="{{ $foto?->temporaryUrl() }}"
                                alt="Foto Personal"
                                class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Al enviar estas imágenes, aceptas que verifiquemos tu identidad. Un administrador revisará esta información para activar tu cuenta. De no enviar nada en un plazo de 24 horas, este usuario se eliminará.
                </p>
            </div>

            <div class="mt-6 flex justify-end">
                <div x-data="{ showAlert: false }">
                    <!-- Botón para disparar la alerta -->
                    <button type="button" @click="showAlert = true" class="bg-blue-600 hover:bg-blue-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Enviar verificación
                    </button>

                    <!-- Alerta de confirmación -->
                    <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">¿Estás seguro de enviar estas imágenes?</h2>
                            <p class="text-gray-600 dark:text-gray-400 mt-2">Esta información será revisada por un administrador para verificar tu identidad.</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" @click="showAlert = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                    Cancelar
                                </button>
                                <button type="submit" @click="showAlert = false" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
