<div>
    <a wire:navigate href="{{ route('usuarios.index') }}">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Volver
        </button>
    </a>
    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit.prevent="guardarUsuario" class="space-y-6" enctype="multipart/form-data">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos del Usuario</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="Name" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input wire:model="name" type="text" id="name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                    <input wire:model="email" type="text" id="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input wire:model="password" type="password" id="password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Confirmar Contraseña</label>
                    <input wire:model="password_confirmation" type="password" id="password_confirmation" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="persona">Persona</label>
                        <div class="flex">
                            <input
                                name="persona"
                                wire:model="persona_id"
                                id="persona"
                                x-data="{ personaNombre: @entangle('nombrePersona') }"
                                x-model="personaNombre"
                                x-on:persona-seleccionada.window="(e) => {
                                    $wire.set('persona_id', e.detail.id);
                                    personaNombre = e.detail.nombre;
                                    $wire.set('nombrePersona', e.detail.nombre);
                                }"
                                placeholder="Buscar persona"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" x-on:click="$dispatch('open-persona-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                                Buscar
                            </button>
                        </div>
                        
                    </div>
                </div>
                @error('persona_id')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            <div class="mb-6"
                x-data="{ uploading: false, progress: 0, showModal: false, fileReady: false }"
                x-init="$watch('uploading', value => { if (!value) fileReady = true; })"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300" for="ruta_foto">Foto</label>
                <div :class="fileReady ? 'grid grid-cols-2 gap-4 items-center' : 'block'" class="transition-all duration-300">
                    <input
                        wire:model.defer="ruta_foto"
                        name="ruta_foto"
                        id="ruta_foto"
                        type="file"
                        accept="image/*,.pdf"
                        class="block w-full text-sm text-gray-100
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-white
                            hover:file:bg-blue-700
                            bg-gray-800 border border-gray-700 rounded-md px-5 py-2"
                    />
                    @error('ruta_foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Botón para ver la imagen solo si ya está lista -->
                    <div x-show="fileReady && $wire.ruta_foto" x-transition>
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
                            Ver foto
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

                <!-- Modal para ver la imagen -->
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
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Foto cargada</h2>
                        <img
                            src="{{ $ruta_foto?->temporaryUrl() }}"
                            alt="Foto"
                            class="w-full h-auto rounded-md border border-gray-300 dark:border-gray-600"
                        >
                    </div>
                </div>
            </div>

            <div class="pt-6 text-right">
                <a wire:navigate href="{{ route('usuarios.index') }}"></a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                    Registrar Usuario
                </button>
            </div>
        </form>
            {{-- Modal Selección de Persona --}}
            <div x-data="{ showModal: false }"
            x-on:open-persona-modal.window="showModal = true"
            x-on:close-persona-modal.window="showModal = false">
            <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Seleccionar Persona</h3>
                        <button x-on:click="$dispatch('close-persona-modal')" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            ✖
                        </button>
                    </div>
                    <div class="p-4">
                        <div x-data="{
                            personas: @js($personas),
                            search: '',
                            paginaActual: 1,
                            porPagina: 5,

                            init() {
                                this.$watch('search', () => {
                                    if (this.paginaActual > this.totalPaginas) {
                                        this.paginaActual = 1;
                                    }
                                });
                            },

                            get personasFiltradas() {
                                if (!this.search) return this.personas;
                                const s = this.search.toLowerCase();
                                return this.personas.filter(p =>
                                    (p.dni?.toLowerCase().includes(s) || '') ||
                                    (p.nombre?.toLowerCase().includes(s) || '') ||
                                    (p.apellido?.toLowerCase().includes(s) || '')
                                );
                            },

                            get personasPaginadas() {
                                let inicio = (this.paginaActual - 1) * this.porPagina;
                                return this.personasFiltradas.slice(inicio, inicio + this.porPagina);
                            },

                            get totalPaginas() {
                                return Math.max(1, Math.ceil(this.personasFiltradas.length / this.porPagina));
                            }
                        }">
                            <div class="mb-4">
                                <label for="search-persona" class="sr-only">Buscar persona</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input
                                        x-model="search"
                                        @input="paginaActual = 1"
                                        type="search"
                                        id="search-persona"
                                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Buscar por DNI, nombre o apellido..."
                                    />
                                </div>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">DNI</th>
                                            <th scope="col" class="px-6 py-3">Nombre</th>
                                            <th scope="col" class="px-6 py-3">Apellido</th>
                                            <th scope="col" class="px-6 py-3">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-4" x-text="persona.dni || 'N/A'"></td>
                                                <td class="px-6 py-4" x-text="persona.nombre || 'N/A'"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido || 'N/A'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button
                                                        @click="() => {
                                                            $dispatch('persona-seleccionada', {
                                                                id: persona.id,
                                                                nombre: `${persona.nombre || ''} ${persona.apellido || ''}`
                                                            });
                                                            $dispatch('close-persona-modal');
                                                        }"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded"
                                                    >
                                                        Seleccionar
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr x-show="personasFiltradas.length === 0">
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                No se encontraron personas
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <button
                                    @click="paginaActual = Math.max(paginaActual - 1, 1)"
                                    :disabled="paginaActual === 1"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50"
                                >
                                    Anterior
                                </button>
                                <span x-text="`Página ${paginaActual} de ${totalPaginas}`" class="text-sm text-gray-700 dark:text-gray-300"></span>
                                <button
                                    @click="paginaActual = Math.min(paginaActual + 1, totalPaginas)"
                                    :disabled="paginaActual === totalPaginas"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50"
                                >
                                    Siguiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
