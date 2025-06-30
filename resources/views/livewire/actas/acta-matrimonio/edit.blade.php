<div>
    <a href="{{ route('actas-matrimonio') }}">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Volver
        </button>
    </a>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit.prevent="actualizar" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos del Acta</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="acta" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">N° de Acta</label>
                    <input disabled wire:model="acta_id" type="text" id="acta" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('acta_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Libro</label>
                    <input disabled wire:model="libro_id" type="text" id="libro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('libro_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="folio" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Folio</label>
                    <input disabled wire:model="folio_id" type="text" id="folio" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    @error('folio_id')
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
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pt-6 pb-2">Datos del Matrimonio</h2>

            <div class="mb-6">
                <label class="text-white block mb-1" for="fecha_matrimonio">Fecha de Matrimonio</label>
                <input wire:model="fecha_matrimonio" name="fecha_matrimonio" id="fecha_matrimonio" class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2" type="date">
                @error('fecha_matrimonio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <h2 class="text-white font-bold text-lg mb-4">Novios</h2>

            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="novio">Novio</label>
                    <div class="flex">
                        <input
                            name="novio"
                            wire:model="novio_id"
                            id="novio"
                            x-data="{ novioNombre: '{{$nombreNovio}}' }"
                            x-model="novioNombre"
                            x-on:novio-seleccionado.window="(e) => {
                                $wire.set('novio_id', e.detail.id);
                                novioNombre = e.detail.nombre;
                            }"
                            placeholder="Buscar novio"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                        <button type="button" x-on:click="$dispatch('open-novio-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('novio_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="novia">Novia</label>
                    <div class="flex">
                        <input
                            name="novia"
                            wire:model="novia_id"
                            id="novia"
                            x-data="{ noviaNombre: '{{$nombreNovia}}' }"
                            x-model="noviaNombre"
                            x-on:novia-seleccionado.window="(e) => {
                                $wire.set('novia_id', e.detail.id);
                                noviaNombre = e.detail.nombre;
                            }"
                            placeholder="Buscar novia"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                        <button type="button" x-on:click="$dispatch('open-novia-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('novia_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h2 class="text-white font-bold text-lg mb-4">Testigos</h2>

            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="testigo1">Testigo 1</label>
                    <div class="flex">
                        <input
                            name="testigo1"
                            wire:model="testigo1_id"
                            id="testigo1"
                            x-data="{ testigo1Nombre: '{{$nombreTestigo1}}' }"
                            x-model="testigo1Nombre"
                            x-on:testigo1-seleccionado.window="(e) => {
                                $wire.set('testigo1_id', e.detail.id);
                                testigo1Nombre = e.detail.nombre;
                            }"
                            placeholder="Buscar testigo 1"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                        <button type="button" x-on:click="$dispatch('open-testigo1-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('testigo1_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-row space-x-4 mb-6">
                <div class="flex-1">
                    <label class="text-white block mb-1" for="testigo2">Testigo 2</label>
                    <div class="flex">
                        <input
                            name="testigo2"
                            wire:model="testigo2_id"
                            id="testigo2"
                            x-data="{ testigo2Nombre: '{{$nombreTestigo2}}' }"
                            x-model="testigo2Nombre"
                            x-on:testigo2-seleccionado.window="(e) => {
                                $wire.set('testigo2_id', e.detail.id);
                                testigo2Nombre = e.detail.nombre;
                            }"
                            placeholder="Buscar testigo 2"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                        <button type="button" x-on:click="$dispatch('open-testigo2-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                            Buscar
                        </button>
                    </div>
                    @error('testigo2_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{route('matrimonios-pdf',['id'=>$id_acta])}}">
                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Descargar acta
                    </button>
                </a>

                <div x-data="{ showAlert: false }">
                    <button type="button" @click="showAlert = true" class="bg-green-600 hover:bg-green-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Editar acta
                    </button>
                    <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                            <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro?</h2>
                            <p class="text-gray-600 mt-2">No podrás revertir esta acción.</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" @click="showAlert = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                    Cancelar
                                </button>
                                <button type="submit" @click="showAlert = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session()->has('mensaje'))
                <div class="mt-4 p-2 bg-green-100 text-green-700 rounded">
                    {{ session('mensaje') }}
                </div>
            @endif
        </form>
    </div>

    {{-- Modales --}}
    {{-- Novio --}}
    <div x-data="{ showModal: false }"
         x-on:open-novio-modal.window="showModal = true"
         x-on:close-novio-modal.window="showModal = false">
        <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar Novio
                    </h3>
                    <button
                        x-on:click="$dispatch('close-novio-modal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <div class="p-4">
                    <div x-data="{
                        personas: @js($personasSolterasNovio),
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
                            <input @input="paginaActual = 1" x-model="search" type="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                        </div>
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-6 py-3">DNI</th>
                                            <th class="px-6 py-3">Nombre</th>
                                            <th class="px-6 py-3">Apellido</th>
                                            <th class="px-6 py-3">Edad</th>
                                            <th class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear() + ' años'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="() => {
                                                        $dispatch('novio-seleccionado', {id: persona.id, nombre: persona.nombre + ' ' + persona.apellido});
                                                        $dispatch('close-novio-modal');
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
                                <span x-text="'Página ' + paginaActual + ' de ' + totalPaginas"></span>
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

    {{-- Novia --}}
    <div x-data="{ showModal: false }"
         x-on:open-novia-modal.window="showModal = true"
         x-on:close-novia-modal.window="showModal = false">
        <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar Novia
                    </h3>
                    <button
                        x-on:click="$dispatch('close-novia-modal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <div class="p-4">
                    <div x-data="{
                        personas: @js($personasSolterasNovia),
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
                            <input @input="paginaActual = 1" x-model="search" type="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                        </div>
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-6 py-3">DNI</th>
                                            <th class="px-6 py-3">Nombre</th>
                                            <th class="px-6 py-3">Apellido</th>
                                            <th class="px-6 py-3">Edad</th>
                                            <th class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear() + ' años'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="() => {
                                                        $dispatch('novia-seleccionado', {id: persona.id, nombre: persona.nombre + ' ' + persona.apellido});
                                                        $dispatch('close-novia-modal');
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
                                <span x-text="'Página ' + paginaActual + ' de ' + totalPaginas"></span>
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

    {{-- Testigo 1 --}}
    <div x-data="{ showModal: false }"
         x-on:open-testigo1-modal.window="showModal = true"
         x-on:close-testigo1-modal.window="showModal = false">
        <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
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
                            <input @input="paginaActual = 1" x-model="search" type="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                        </div>
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-6 py-3">DNI</th>
                                            <th class="px-6 py-3">Nombre</th>
                                            <th class="px-6 py-3">Apellido</th>
                                            <th class="px-6 py-3">Edad</th>
                                            <th class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear() + ' años'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="() => {
                                                        $dispatch('testigo1-seleccionado', {id: persona.id, nombre: persona.nombre + ' ' + persona.apellido});
                                                        $dispatch('close-testigo1-modal');
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
                                <span x-text="'Página ' + paginaActual + ' de ' + totalPaginas"></span>
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

    {{-- Testigo 2 --}}
    <div x-data="{ showModal: false }"
         x-on:open-testigo2-modal.window="showModal = true"
         x-on:close-testigo2-modal.window="showModal = false">
        <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
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
                            <input @input="paginaActual = 1" x-model="search" type="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar personas..." />
                        </div>
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-6 py-3">DNI</th>
                                            <th class="px-6 py-3">Nombre</th>
                                            <th class="px-6 py-3">Apellido</th>
                                            <th class="px-6 py-3">Edad</th>
                                            <th class="px-6 py-3"><span class="sr-only">Acción</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="persona in personasPaginadas" :key="persona.id">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-white" x-text="persona.dni"></th>
                                                <td class="px-6 py-4" x-text="persona.nombre"></td>
                                                <td class="px-6 py-4" x-text="persona.apellido"></td>
                                                <td class="px-6 py-4" x-text="new Date().getFullYear() - new Date(persona.fecha_nacimiento).getFullYear() + ' años'"></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button @click="() => {
                                                        $dispatch('testigo2-seleccionado', {id: persona.id, nombre: persona.nombre + ' ' + persona.apellido});
                                                        $dispatch('close-testigo2-modal');
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
                                <span x-text="'Página ' + paginaActual + ' de ' + totalPaginas"></span>
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