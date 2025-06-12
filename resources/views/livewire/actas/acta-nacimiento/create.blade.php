<div>
    <div>
        <a href="{{ route('actas-nacimiento') }}" wire:navigate>
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Volver
            </button>
        </a>
    </div>
    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit.prevent="guardarNacimiento" class="space-y-6">

            <!-- Datos del Acta -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos del Acta</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="acta_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Número de Acta</label>
                    <input type="text" id="acta_id" wire:model="acta_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('acta_id')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Número de Libro</label>
                    <input type="text" id="libro" wire:model="libro_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('libro_id')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <label for="folio" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Número de Folio</label>
                    <input type="text" id="folio" wire:model="folio_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('folio_id')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <label for="fecha_registro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Registro</label>
                    <input type="date" id="fecha_registro" wire:model="fecha_registro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('fecha_registro')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
            </div>

            <!-- Datos del Nacido -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pt-6 pb-2">Datos del Nacido</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" id="nombre" wire:model="nombre_nacido" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('nombre_nacido')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <label for="apellido" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Apellido</label>
                    <input type="text" id="apellido" wire:model="apellido_nacido" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('apellido_nacido')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="sexo" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Sexo</label>
                    <select id="sexo" wire:model="sexo" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        <option value="">Seleccione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    @error('sexo')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
                <div>
                    <label for="fecha_nacimiento" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" wire:model="fecha_nacimiento" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('fecha_nacimiento')
                        <x-input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>
            </div>
            <div>
                <label for="lugar_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Lugar de Nacimiento</label>
                <select id="lugar_id" wire:model="lugar_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Seleccione un lugar</option>
                    @foreach($lugares as $lugar)
                        <option value="{{ $lugar->id }}">
                            {{ $lugar->distrito }}, {{ $lugar->provincia }}, {{ $lugar->departamento }}, {{ $lugar->pais }}
                        </option>
                    @endforeach
                </select>
                @error('lugar_id')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Datos de los Padres -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pt-6 pb-2">Datos de los Padres</h2>

            <!-- Búsqueda de madre -->
            <div class="mb-6">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Madre</label>
                <div class="flex">
                    <input
                        wire:model="madre_id"
                        x-data="{ madreNombre: '' }"
                        x-model="madreNombre"
                        x-on:madre-seleccionada.window="(e) => {
                            $wire.set('madre_id', e.detail.id);
                            madreNombre = e.detail.nombre;
                        }"
                        placeholder="Buscar madre"
                        class="flex-1 rounded-l-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2"
                        type="text"
                        readonly>
                    <button type="button" x-on:click="$dispatch('open-madre-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg">
                        Buscar
                    </button>
                </div>
                @error('madre_id')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Búsqueda de padre -->
            <div class="mb-6">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Padre</label>
                <div class="flex">
                    <input
                        wire:model="padre_id"
                        x-data="{ padreNombre: '' }"
                        x-model="padreNombre"
                        x-on:padre-seleccionado.window="(e) => {
                            $wire.set('padre_id', e.detail.id);
                            padreNombre = e.detail.nombre;
                        }"
                        placeholder="Buscar padre"
                        class="flex-1 rounded-l-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2"
                        type="text"
                        readonly>
                    <button type="button" x-on:click="$dispatch('open-padre-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg">
                        Buscar
                    </button>
                </div>
                @error('padre_id')
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Botón de envío con confirmación -->
            <div class="pt-6 text-right">
                <div x-data="{ showAlert: false }">
                    <button type="button" @click="showAlert = true" class="px-6 py-2 text-white bg-gray-700 hover:bg-gray-800 rounded-lg dark:bg-gray-600 dark:hover:bg-gray-700">
                        Registrar Nacimiento
                    </button>

                    <!-- Alerta de confirmación -->
                    <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-96 dark:bg-gray-800">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">¿Confirmar registro?</h2>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">¿Está seguro de registrar este nacimiento?</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" @click="showAlert = false" class="px-4 py-2 text-gray-800 bg-gray-300 hover:bg-gray-400 rounded-md dark:text-white dark:bg-gray-600 dark:hover:bg-gray-700">
                                    Cancelar
                                </button>
                                <button type="submit" @click="showAlert = false" class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-md dark:bg-green-700 dark:hover:bg-green-800">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal para Buscar Madre -->
    <div x-data="{ showMadreModal: false }" x-on:open-madre-modal.window="showMadreModal = true" x-on:close-madre-modal.window="showMadreModal = false">
        <div x-show="showMadreModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Seleccionar Madre
                    </h3>
                    <button
                        x-on:click="$dispatch('close-madre-modal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <div x-data="{
                        personas: @js($personas),
                        buscarMadre: '',
                        paginaActual: 1,
                        porPagina: 3,

                        init() {
                            this.$watch('buscarMadre', () => {
                                if (this.paginaActual > this.totalPaginas) {
                                    this.paginaActual = 1;
                                }
                            });
                        },

                        get personasFiltradas() {
                            if (!this.buscarMadre) return this.personas;
                            const s = this.buscarMadre.toLowerCase();
                            return this.personas.filter(p =>
                                (p.dni?.toLowerCase().includes(s) || '') ||
                                p.nombre.toLowerCase().includes(s) ||
                                p.apellido.toLowerCase().includes(s)
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
                            <label for="input-madre" class="sr-only">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input @input="paginaActual = 1" x-model="buscarMadre" type="search" id="input-madre" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar madres..." />
                            </div>
                        </div>

                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">DNI</th>
                                            <th scope="col" class="px-6 py-3">Nombre</th>
                                            <th scope="col" class="px-6 py-3">Apellido</th>
                                            <th scope="col" class="px-6 py-3">Edad</th>
                                            <th scope="col" class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni || 'N/A'"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="persona.fecha_nacimiento ? `${new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear()} años` : 'N/A'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="()=>{
                                                                $dispatch('madre-seleccionada',{id: persona.id,nombre: `${persona.nombre} ${persona.apellido}`})
                                                                $dispatch('close-madre-modal');
                                                            }"
                                                        type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                                        Seleccionar
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div x-show="personasFiltradas.length === 0" class="mt-4 text-center text-gray-500">
                                No se encontraron personas.
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <button
                                    @click="paginaActual = Math.max(paginaActual - 1, 1)"
                                    :disabled="paginaActual === 1"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50">
                                    Anterior
                                </button>
                                <span x-text="`Página ${paginaActual} de ${totalPaginas}`"></span>
                                <button
                                    @click="paginaActual = Math.min(paginaActual + 1, totalPaginas)"
                                    :disabled="paginaActual === totalPaginas"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50">
                                    Siguiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Buscar Padre -->
    <div x-data="{ showPadreModal: false }" x-on:open-padre-modal.window="showPadreModal = true" x-on:close-padre-modal.window="showPadreModal = false">
        <div x-show="showPadreModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Seleccionar Padre
                    </h3>
                    <button
                        x-on:click="$dispatch('close-padre-modal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <div x-data="{
                        personas: @js($personas),
                        buscarPadre: '',
                        paginaActual: 1,
                        porPagina: 3,

                        init() {
                            this.$watch('buscarPadre', () => {
                                if (this.paginaActual > this.totalPaginas) {
                                    this.paginaActual = 1;
                                }
                            });
                        },

                        get personasFiltradas() {
                            if (!this.buscarPadre) return this.personas;
                            const s = this.buscarPadre.toLowerCase();
                            return this.personas.filter(p =>
                                (p.dni?.toLowerCase().includes(s) || '') ||
                                p.nombre.toLowerCase().includes(s) ||
                                p.apellido.toLowerCase().includes(s)
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
                            <label for="input-padre" class="sr-only">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input @input="paginaActual = 1" x-model="buscarPadre" type="search" id="input-padre" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar padres..." />
                            </div>
                        </div>

                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">DNI</th>
                                            <th scope="col" class="px-6 py-3">Nombre</th>
                                            <th scope="col" class="px-6 py-3">Apellido</th>
                                            <th scope="col" class="px-6 py-3">Edad</th>
                                            <th scope="col" class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni || 'N/A'"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="persona.fecha_nacimiento ? `${new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear()} años` : 'N/A'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="()=>{
                                                                $dispatch('padre-seleccionado',{id: persona.id,nombre: `${persona.nombre} ${persona.apellido}`})
                                                                $dispatch('close-padre-modal');
                                                            }"
                                                        type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                                        Seleccionar
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div x-show="personasFiltradas.length === 0" class="mt-4 text-center text-gray-500">
                                No se encontraron personas.
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <button
                                    @click="paginaActual = Math.max(paginaActual - 1, 1)"
                                    :disabled="paginaActual === 1"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50">
                                    Anterior
                                </button>
                                <span x-text="`Página ${paginaActual} de ${totalPaginas}`"></span>
                                <button
                                    @click="paginaActual = Math.min(paginaActual + 1, totalPaginas)"
                                    :disabled="paginaActual === totalPaginas"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50">
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
