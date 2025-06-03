<div >
    <div>
        @if ($mostrarAlerta)
            <div role="alert" class="rounded-md border border-gray-300 bg-white p-4 shadow-sm">
                <div class="flex items-start gap-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 text-green-600"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                    <div class="flex-1">
                        <strong class="font-medium text-gray-900"> Registro guardado </strong>
                        <p class="mt-0.5 text-sm text-gray-700">El registro ha sido actualizado correctamente</p>
                    </div>

                    <button
                        wire:click="cerrarAlerta"
                        class="-m-3 rounded-full p-1.5 text-gray-500 transition-colors hover:bg-gray-50 hover:text-gray-700"
                        type="button"
                        aria-label="Dismiss alert"
                    >
                        <span class="sr-only">Dismiss popup</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div class="flex  justify-center  bg-gray-100 gap-4">
        <div class="card bg-base-100 w-96 shadow-sm">
            <figure class="px-10 pt-10">
              <img
                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                alt="Shoes"
                class="rounded-xl" />
            </figure>
            <div class="card-body items-center text-center">
              <h2 class="card-title">Los usuarios</h2>
              <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
              <div class="card-actions">
                <button class="btn btn-primary" onclick="my_modal_2.showModal()">Crear usuarios</button>
              </div>
            </div>
        </div>

        <div class="card bg-base-100 w-96 shadow-sm">
            <figure class="px-10 pt-10">
              <img
                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                alt="Shoes"
                class="rounded-xl" />
            </figure>
            <div class="card-body items-center text-center">
              <h2 class="card-title">Los roles</h2>
              <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
              <div class="card-actions">
                <button class="btn btn-primary" onclick="my_modal_3.showModal()">Administrar roles y permisos</button>
              </div>
            </div>
        </div>
    </div>

{{--
<dialog id="my_modal_2" class="modal">
  <div class="modal">
    <button type="button" onclick="my_modal_2.close()" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    <div>
        <form wire:submit="registrarUsuario"  class="p-4 md:p-5">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de usuario</label>
                    <input wire:model="user_name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escoger una persona</label>
                    <select wire:model="persona_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Seleccionar persona</option>
                        @foreach ($personas as $persona )
                            <option value="{{$persona->id}}">{{$persona->nombre}} {{$persona->apellido}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir foto</label>
                    <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Sin foto</option>
                    </select>
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
            <button onclick="my_modal_2.close()" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add new product
            </button>
        </form>
    </div>
    <p class="py-4">Press ESC key or click on ✕ button to close</p>
  </div>
</dialog>

<dialog id="my_modal_3" class="modal">
    <div class="modal-box">
        <button type="button" onclick="my_modal_3.close()" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      <div>
          <form wire:submit="asignarRol" class="p-4 md:p-5">
              <div class="grid gap-4 mb-4 grid-cols-2">


                  <div class="col-span-2 sm:col-span-1">
                      <label for="cat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escoger un usuario</label>
                      <select wire:model="user" id="cat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option  selected="">Seleccionar usuario</option>
                          @foreach ($usuarios as $usuario )
                              <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                          @endforeach

                      </select>
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escoger el rol</label>
                      <select wire:model="rol" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Seleccionar rol</option>
                            @foreach ($roles as $rol )
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                      </select>
                  </div>


              </div>
              <div class="flex justify-center">
                <button onclick="my_modal_3.close()" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Confirmar
                </button>
              </div>
          </form>
      </div>
      <p class="py-4">Press ESC key or click on ✕ button to close</p>
    </div>
  </dialog> --}}



  <div x-data="{
            showModal: false,
            loadFlowbite() {
                if (!window.flowbiteLoaded) {
                import('https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js')
                    .then(() => {
                    console.log('Flowbite inicializado');
                    window.flowbiteLoaded = true; // Marcar Flowbite como cargado
                })
                .catch((error) => {
                    console.error('Error al cargar Flowbite:', error);
                });
            }
            }
        }"
                x-init="window.flowbiteLoaded = false"
                x-on:open-modal.window="showModal = true; loadFlowbite()"
                x-on:close-modal.window="showModal = false"
            >
<!-- Botón para abrir el modal -->
<button
    x-on:click="$dispatch('open-modal')"
    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Toggle modal
</button>

<!-- Modal -->
<div
    x-show="showModal"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50"
    style="display: none;"
>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-96">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Create New Product
            </h3>
            <button
                x-on:click="$dispatch('close-modal')"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
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
                    <input wire:model="user_name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escoger una persona</label>
                    <select wire:model="persona_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Seleccionar persona</option>
                        @foreach ($personas as $persona )
                            <option value="{{$persona->id}}">{{$persona->nombre}} {{$persona->apellido}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir foto</label>
                    <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Sin foto</option>
                    </select>
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
            <button onclick="my_modal_2.close()" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add new product
            </button>
        </form>
    </div>
</div>
</div>
</div>
