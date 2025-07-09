<!-- filepath: /c:/Users/Usuario/Desktop/Laravel/Project_Git/registro-civil/resources/views/livewire/administracion/validar-usuario.blade.php -->
<div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2 mb-4">
            Solicitudes de verificación de identidad
        </h2>

        @if(count($solicitudes) > 0)
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">Usuario</th>
                            <th scope="col" class="py-3 px-6">Email</th>
                            <th scope="col" class="py-3 px-6">Fecha solicitud</th>
                            <th scope="col" class="py-3 px-6">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$solicitud->usuar->persona->nombre}} {{$solicitud->usuar->persona->apellido}}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $solicitud->usuar->email ?? 'Sin email' }}
                                </td>
                                <td class="py-4 px-6">
                                    {{  $solicitud->fecha  }}
                                </td>
                                <td class="py-4 px-6">
                                    <button
                                        wire:click="verDetalles({{ $solicitud->id }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        Ver detalles
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex items-center justify-center p-6 text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-lg">No hay solicitudes de verificación pendientes</span>
            </div>
        @endif
    </div>

    <!-- Modal de detalles -->
    @if($solicitudSeleccionada)
        <div class="fixed inset-0 z-50 overflow-y-auto"
            x-data="{ show: @entangle('mostrarModal') }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="show"></div>

                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-start pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                Verificación de {{ $solicitudSeleccionada->usuar->persona->nombre }} {{ $solicitudSeleccionada->usuar->persona->apellido }}
                            </h3>
                            <button @click="show = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información del usuario -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-2">Información del usuario</h4>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nombre:</span>
                                        <span class="text-gray-800 dark:text-white">{{ $solicitudSeleccionada->usuar->name ?? 'No disponible' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email:</span>
                                        <span class="text-gray-800 dark:text-white">{{ $solicitudSeleccionada->usuar->email ?? 'No disponible' }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de solicitud:</span>
                                        <span class="text-gray-800 dark:text-white">{{  $solicitudSeleccionada->fecha}}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- DNI Anverso -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-2">DNI Anverso</h4>
                                <div class="relative bg-gray-50 dark:bg-gray-700 p-2 rounded-lg">
                                    <img
                                        src="{{asset('storage/'.$solicitudSeleccionada->dni_anverso) }}"
                                        alt="DNI Anverso"
                                        class="w-full h-auto object-contain rounded-md max-h-40"
                                    >
                                    <a
                                        href="{{asset('storage/'.$solicitudSeleccionada->dni_anverso) }}"
                                        target="_blank"
                                        class="absolute bottom-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-md hover:bg-blue-700"
                                    >
                                        Ver completa
                                    </a>
                                </div>
                            </div>

                            <!-- DNI Reverso -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-2">DNI Reverso</h4>
                                <div class="relative bg-gray-50 dark:bg-gray-700 p-2 rounded-lg">
                                    <img
                                        src="{{ asset('storage/'.$solicitudSeleccionada->dni_reverso) }}"
                                        alt="DNI Reverso"
                                        class="w-full h-auto object-contain rounded-md max-h-40"
                                    >
                                    <a
                                        href="{{asset('storage/'.$solicitudSeleccionada->dni_reverso) }}"
                                        target="_blank"
                                        class="absolute bottom-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-md hover:bg-blue-700"
                                    >
                                        Ver completa
                                    </a>
                                </div>
                            </div>

                            <!-- Foto personal -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-2">Foto Personal</h4>
                                <div class="relative bg-gray-50 dark:bg-gray-700 p-2 rounded-lg">
                                    <img
                                        src="{{asset('storage/'.$solicitudSeleccionada->foto) }}"
                                        alt="Foto Personal"
                                        class="w-full h-auto object-contain rounded-md max-h-40"
                                    >
                                    <a
                                        href="{{asset('storage/'.$solicitudSeleccionada->foto) }}"
                                        target="_blank"
                                        class="absolute bottom-4 right-4 bg-blue-600 text-white text-xs px-2 py-1 rounded-md hover:bg-blue-700"
                                    >
                                        Ver completa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            wire:click="aprobarUsuario({{ $solicitudSeleccionada->id }})"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Aprobar y activar usuario
                        </button>
                        <button
                            wire:click="rechazarUsuario({{ $solicitudSeleccionada->id }})"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Rechazar solicitud
                        </button>
                        <button
                            @click="show = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:border-gray-500 dark:hover:bg-gray-500"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Notificaciones con SweetAlert -->
    <script>
        document.addEventListener('livewire:initialized', function () {
            @this.on('mostrarMensaje', (data) => {
                Swal.fire({
                    icon: data.tipo,
                    title: data.titulo,
                    text: data.mensaje,
                    confirmButtonColor: '#3085d6',
                });
            });
        });
    </script>
</div>
