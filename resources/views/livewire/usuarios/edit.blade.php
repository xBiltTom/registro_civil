<div>
    <a href="{{ route('usuarios.index') }}">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Volver
        </button>
    </a>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">

        <form wire:submit.prevent="actualizar" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Editar Usuario</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="Name" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input wire:model="name" type="text" id="name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                    <input wire:model="email" type="email" id="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nueva Contraseña (opcional)</label>
                    <input wire:model="password" type="password" id="password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Estado</label>
                    <select wire:model="estado" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ruta_foto" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Ruta de Foto</label>
                    <input wire:model="ruta_foto" type="text" id="ruta_foto" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('ruta_foto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                    @error('persona_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-6 text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                    Editar Usuario
                </button>
            </div>
        </form>

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
                                    if (this.paginaActual > this.totalPaginas) this.paginaActual = 1;
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
                                const i = (this.paginaActual - 1) * this.porPagina;
                                return this.personasFiltradas.slice(i, i + this.porPagina);
                            },
                            get totalPaginas() {
                                return Math.max(1, Math.ceil(this.personasFiltradas.length / this.porPagina));
                            }
                        }">
                            <input x-model="search" @input="paginaActual = 1" type="search" placeholder="Buscar persona..." class="block w-full p-2 mb-4 rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white" />

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-2">DNI</th>
                                        <th class="px-4 py-2">Nombre</th>
                                        <th class="px-4 py-2">Apellido</th>
                                        <th class="px-4 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="persona in personasPaginadas" :key="persona.id">
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-4 py-2" x-text="persona.dni"></td>
                                            <td class="px-4 py-2" x-text="persona.nombre"></td>
                                            <td class="px-4 py-2" x-text="persona.apellido"></td>
                                            <td class="px-4 py-2 text-right">
                                                <button
                                                    @click="() => {
                                                        $dispatch('persona-seleccionada', {id: persona.id, nombre: persona.nombre + ' ' + persona.apellido});
                                                        $dispatch('close-persona-modal');
                                                    }"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                                    Seleccionar
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>

                            <div class="flex justify-between items-center mt-4">
                                <button @click="paginaActual = Math.max(paginaActual - 1, 1)" :disabled="paginaActual === 1" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md disabled:opacity-50">Anterior</button>
                                <span x-text="'Página ' + paginaActual + ' de ' + totalPaginas"></span>
                                <button @click="paginaActual = Math.min(paginaActual + 1, totalPaginas)" :disabled="paginaActual === totalPaginas" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md disabled:opacity-50">Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
