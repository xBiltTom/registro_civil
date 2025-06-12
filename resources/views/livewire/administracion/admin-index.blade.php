<div >
    @if(session('message'))
    <div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 transition-opacity duration-500 ease-out"
    role="alert"
>
    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
        <span class="font-medium">Correcto !</span> {{ session('message') }}
    </div>
</div>

    @endif

    <div class="flex  justify-center  bg-gray-700 gap-4">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#"><h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Los usuarios</h5></a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                <button type="button" x-on:click="$dispatch('open-modal')"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Crear usuario
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#"><h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Los roles</h5></a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                <button type="button" x-on:click="$dispatch('open-assign-roles-modal')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Asignar roles
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para Asignar Roles -->
    <div x-data="{ showAssignRolesModal: false }" x-on:open-assign-roles-modal.window="showAssignRolesModal = true" x-on:close-assign-roles-modal.window="showAssignRolesModal = false">
        <div x-show="showAssignRolesModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96">
            <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar Roles
                    </h3>
                    <button
                        x-on:click="$dispatch('close-assign-roles-modal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit.prevent="asignarRol" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                            <select wire:model="user" id="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="" selected>Seleccionar usuario</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                            <select wire:model="rol" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="" selected>Seleccionar rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button x-on:click="$dispatch('close-assign-roles-modal')" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Asignar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div x-data="{
            showModal: false,
            loadFlowbite() {
                if (!window.flowbiteLoaded) {
                    import('https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js')
                        .then(() => {
                            console.log('Flowbite inicializado');
                            window.flowbiteLoaded = true; // Marcar Flowbite como cargado
                        }).catch((error) => {
                            console.error('Error al cargar Flowbite:', error);
                        });
                }
            }
        }"
        x-init="window.flowbiteLoaded = false"
        x-on:open-modal.window="showModal = true; loadFlowbite()" x-on:close-modal.window="showModal = false">
            <div x-show="showModal" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50" style="display: none;">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Crea un nuevo usuario
                        </h3>
                        <button x-on:click="$dispatch('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit="registrarUsuario"  class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de usuario</label>
                            <input wire:model="user_name" type="text" name="name" id="name" class="bg-gray-0 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>

                        <div class="col-span-2">
                            <label class="text-white block mb-1" for="persona">Persona asociada: </label>
                            <div class="flex">
                                <input name="declarante" wire:model="persona_id" id="persona" placeholder=""
                                    x-data="{ declaranteNombre: '' }"
                                    x-model="declaranteNombre"
                                    x-on:declarante-seleccionado.window="(e) => {
                                        $wire.set('persona_id', e.detail.id);
                                        declaranteNombre = e.detail.nombre;
                                    }"

                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2" type="text" readonly>
                                <button type="button" x-on:click="$dispatch('open-declarante-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                                    Buscar
                                </button>
                            </div>

                        </div>
                <div class="col-span-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                    <input wire:model="correo" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Escriba un correo electronico" required="">
                </div>
                <div  class="col-span-2">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input wire:model="contraseña" type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresa una contraseña" required="">
                </div>

            </div>
                    <div class="flex justify-center">
                        <button x-on:click="$dispatch('close-modal')"  type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Agregar usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-data="{ showDeclarante: false }" x-on:open-declarante-modal.window="showDeclarante = true" x-on:close-declarante-modal.window="showDeclarante = false">
        <div x-show="showDeclarante" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display: none;">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96 sm:w-[40rem]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Asignar usuario
                    </h3>
                    <button
                        x-on:click="()=> {$dispatch('close-declarante-modal');$dispatch('open-modal');}"
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
                            </div>
                        </div>

                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-x-auto dark:bg-gray-700">
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
                                                    <button @click="()=> {
                                                            $dispatch('declarante-seleccionado',{id: persona.id,nombre: `${persona.nombre} ${persona.apellido}`});
                                                            $dispatch('close-declarante-modal');
                                                            $dispatch('open-modal');
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
