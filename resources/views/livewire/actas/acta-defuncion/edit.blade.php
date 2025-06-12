<div>
    <div>
        <a href="{{route('mad')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Volver</button></a>
    </div>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit="actualizar" class="space-y-6">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos del Acta</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="acta" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">N° de Acta</label>
                    <input disabled wire:model="id_acta" type="text" id="acta" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('id_acta')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Libro</label>
                    <input disabled wire:model="id_libro" type="text" id="libro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('id_libro')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="folio" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Folio</label>
                    <input disabled wire:model="id_folio" type="text" id="folio" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('id_folio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="fecha_registro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Registro</label>
                <input disabled wire:model="fecha_registro" type="date" id="fecha_registro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                @error('fecha_registro')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pt-6 pb-2">Datos de la defuncion</h2>

            <div class="mb-6">
                <label class="text-white block mb-1" for="fecha_defuncion">Fecha de Fallecimiento</label>
                <input wire:model="fecha_defuncion" name="fecha_defuncion" id="fecha_defuncion" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="date">
                @error('fecha_defuncion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <h2 class="text-white font-bold text-lg mb-4">Datos del Fallecido</h2>

            <!-- Búsqueda de fallecido -->
            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="fallecido">Fallecido</label>
                    <div class="flex">
                        <input
                            name="fallecido"
                            wire:model="id_fallecido"
                            id="fallecido"
                            x-data="{ fallecidoNombre: '{{$nombreFallecido}}' }"
                            x-model="fallecidoNombre"
                            x-on:fallecido-seleccionado.window="(e) => {
                                $wire.set('id_fallecido', e.detail.id);
                                fallecidoNombre = e.detail.nombre;
                            }"
                            placeholder="Buscar fallecido"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                        <button type="button" x-on:click="$dispatch('open-fallecido-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('id_fallecido')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h2 class="text-white font-bold text-lg mb-4">Datos del Declarante</h2>

            <!-- Búsqueda de declarante -->
            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="declarante">Declarante</label>
                    <div class="flex">
                        <input name="declarante" wire:model="id_declarante" id="declarante" placeholder="@if ($id_declarante==null)Buscar declarante
                                        @else{{$id_declarante}}
                                        @endif"
                            x-data="{ declaranteNombre: '{{$nombreDeclarante}}' }"
                            x-model="declaranteNombre"
                            x-on:declarante-seleccionado.window="(e) => {
                                $wire.set('id_declarante', e.detail.id);
                                declaranteNombre = e.detail.nombre;
                            }"

                        class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2" type="text" readonly>
                        <button type="button" x-on:click="$dispatch('open-declarante-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('id_declarante')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="detalle">Detalles del fallecimiento</label>
                    <div class="flex">
                        <textarea name="detalle" wire:model="detalle" id="detalle"
                        class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2" type="text" >
                        </textarea>
                        @error('detalle')
                            <span class="text-red-500 text-sm">{{ $message }}</span>

                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-between">

                <button type="button" class="bg-red-600 hover:bg-red-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                    Imprimir acta
                </button>

                <div x-data="{ showAlert: false }">
                    <!-- Botón para disparar la alerta -->
                    <button type="button" @click="showAlert = true" class="bg-green-600 hover:bg-green-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Editar acta
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





    <!-- Modal para Asignar Fallecidos -->
    <div x-data="{ showFallecidoModal: false }" x-on:open-fallecido-modal.window="showFallecidoModal = true" x-on:close-fallecido-modal.window="showFallecidoModal = false">
        <div x-show="showFallecidoModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700  w-96 sm:w-[40rem]">
            <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar fallecido
                    </h3>
                    <button
                        x-on:click="$dispatch('close-fallecido-modal')"
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
                        buscarFallecido: '',
                        paginaActual: 1,
                        porPagina: 3,

                        init() {
                            this.$watch('buscarFallecido', () => {
                                if (this.paginaActual > this.totalPaginas) {
                                    this.paginaActual = 1;
                                }
                            });
                        },

                        get personasFiltradas() {
                            if (!this.buscarFallecido) return this.personas;
                            const s = this.buscarFallecido.toLowerCase();
                            return this.personas.filter(p =>
                                p.dni.toLowerCase().includes(s) ||
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
                            <label for="input-fallecido" class="sr-only">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input @input="paginaActual = 1" x-model="buscarFallecido" type="search" id="input-fallecido"  class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
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
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="`${new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear()} años`"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="()=>{
                                                                $dispatch('fallecido-seleccionado',{id: persona.id,nombre: `${persona.nombre} ${persona.apellido}`})
                                                                $dispatch('close-fallecido-modal');
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




    <!-- Modal para Asignar Roles -->
    <!-- Modal para Asignar Roles -->
    <div x-data="{ showDeclarante: false }" x-on:open-declarante-modal.window="showDeclarante = true" x-on:close-declarante-modal.window="showDeclarante = false">
        <div x-show="showDeclarante" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar declarante
                    </h3>
                    <button
                        x-on:click="$dispatch('close-declarante-modal')"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <div x-data="{
                        personas: @js($personas),
                        search: '',
                        paginaActual: 1,
                        porPagina: 3,

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
                                p.dni.toLowerCase().includes(s) ||
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
                            <label for="default-search" class="sr-only">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input @input="paginaActual = 1" x-model="search" type="search" id="default-search" wire:model="nombre" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                                {{-- <button wire:click.prevent="buscarPersonas" class="absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg">
                                    Buscar
                                </button> --}}
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
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="`${new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear()} años`"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="()=>{
                                                        $dispatch('declarante-seleccionado',{id: persona.id,nombre: `${persona.nombre} ${persona.apellido}`})
                                                        $dispatch('close-declarante-modal');
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

