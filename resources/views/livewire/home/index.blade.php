<div class="h-full overflow-auto ">
    <section class="py-10 bg-gray-900 text-white sm:py-16 lg:py-6" wire:poll.5s>
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center mb-10">
                <h2 class="text-3xl font-bold text-white sm:text-4xl sm:leading-tight">Estadísticas del sistema</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-10 sm:grid-cols-2 md:gap-8">
                
                {{-- Personas --}}
                <div class="bg-gray-800 border-l-8 border-blue-500 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('personas.index') }}">
                                <svg class="w-16 h-16 text-blue-500 hover:scale-110 transition-transform duration-200"
                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M12 4a4 4 0 110 8 4 4 0 010-8z"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold">{{ $personas }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-blue-300">Personas registradas</p>
                    </div>
                </div>

                {{-- Defunciones --}}
                <div class="bg-gray-800 border-l-8 border-red-500 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('mad') }}">
                                <svg class="w-16 h-16 text-red-500 hover:scale-110 transition-transform duration-200"
                                     viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 7V17M9 10H15M9 3H15L20 8L15 21H9L4 8L9 3Z"
                                          stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold">{{ $defunciones }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-red-300">Defunciones registradas</p>
                    </div>
                </div>

                {{-- Matrimonios --}}
                <div class="bg-gray-800 border-l-8 border-yellow-400 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('actas-matrimonio') }}">
                                <svg class="w-16 h-16 text-yellow-400 hover:scale-110 transition-transform duration-200"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                          d="M64 208c0 7.8 4.4 18.7 17.1 30.3C126.5 214.1 188.9 200 256 200s129.5 14.1 174.9 38.3C443.6 226.7 448 215.8 448 208c0-12.3-10.8-32-47.9-50.6C364.9 139.8 314 128 256 128s-108.9 11.8-144.1 29.4C74.8 176 64 195.7 64 208zm192 40c-47 0-89.3 7.6-122.9 19.7C166.3 280.2 208.8 288 256 288s89.7-7.8 122.9-20.3C345.3 255.6 303 248 256 248zM0 208c0-49.6 39.4-85.8 83.3-107.8C129.1 77.3 190.3 64 256 64s126.9 13.3 172.7 36.2c43.9 22 83.3 58.2 83.3 107.8v96c0 49.6-39.4 85.8-83.3 107.8C382.9 434.7 321.7 448 256 448s-126.9-13.3-172.7-36.2C39.4 389.8 0 353.6 0 304v-96z"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold">{{ $matrimonios }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-yellow-300">Matrimonios registrados</p>
                    </div>
                </div>

                {{-- Nacimientos --}}
                <div class="bg-gray-800 border-l-8 border-white rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('actas-nacimiento') }}">
                                <svg class="w-16 h-16 text-white hover:scale-110 transition-transform duration-200"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                          d="M152 88a72 72 0 1 1 144 0A72 72 0 1 1 152 88zM39.7 144.5c13-17.9 38-21.8 55.9-8.8L131.8 162c26.8 19.5 59.1 30 92.2 30s65.4-10.5 92.2-30l36.2-26.4c17.9-13 42.9-9 55.9 8.8s9 42.9-8.8 55.9l-36.2 26.4c-13.6 9.9-28.1 18.2-43.3 25v36.3H131.8v-36.3c-15.2-6.7-29.7-15.1-43.3-25L48.5 200.3c-17.9-13-21.8-38-8.8-55.9zm89.8 184.8l60.6 53-26 37.2 24.3 24.3c15.6 15.6 15.6 40.9 0 56.6s-40.9 15.6-56.6 0l-48-48c-13.7-13.7-15.6-35.3-4.5-51.2l50.2-71.8zm128.5 53l60.6-53 50.2 71.8c11.1 15.9 9.2 37.5-4.5 51.2l-48 48c-15.6 15.6-40.9 15.6-56.6 0s-15.6-40.9 0-56.6l24.3-24.3-26-37.2z"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold">{{ $nacimientos }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-gray-300">Nacimientos registrados</p>
                    </div>
                </div>

                {{-- Usuarios --}}
                <div class="bg-gray-800 border-l-8 border-indigo-500 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('usuarios.index') }}">
                                <svg class="w-16 h-16 text-indigo-400 hover:scale-110 transition-transform duration-200"
                                     xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m14.305 19.53.923-.382"/>
                                    <path d="m15.228 16.852-.923-.383"/>
                                    <path d="m16.852 15.228-.383-.923"/>
                                    <path d="m16.852 20.772-.383.924"/>
                                    <path d="M2 21a8 8 0 0 1 10.434-7.62"/>
                                    <path d="m20.772 16.852.924-.383"/>
                                    <path d="m20.772 19.148.924.383"/>
                                    <circle cx="10" cy="8" r="5"/>
                                    <circle cx="18" cy="18" r="3"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold">{{ $usuarios }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-indigo-300">Usuarios registrados</p>
                    </div>
                </div>

                {{-- Administración --}}
                <a href="{{ route('admin') }}"
                   class="block bg-gray-800 hover:bg-gray-700 border-l-8 border-purple-600 rounded-lg shadow transition duration-300">
                    <div class="px-7 py-6 flex items-center">
                        <svg class="w-12 h-12 text-purple-400" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
                            <path d="m4.243 5.21 14.39 12.472"/>
                        </svg>
                        <div class="ml-4">
                            <h3 class="text-2xl font-bold">Administración</h3>
                            <p class="text-sm text-purple-300">Panel de control de roles y usuarios</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>
</div>
