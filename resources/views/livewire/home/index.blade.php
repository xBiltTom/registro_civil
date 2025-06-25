<div class="h-full overflow-auto">
    <section class="py-10 bg-gray-800 sm:py-16 lg:py-6">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">

            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl sm:leading-tight">Estadisticas del sistema</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-8 lg:mt-16 sm:grid-cols-2 md:gap-8">
                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-16 h-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 wire:model.live="personas" class="ml-2 text-6xl font-bold text-gray-900">{{$personas}}</h3>
                        </div>
                        <p class="mt-6 text-base text-gray-600 md:max-w-xs">Personas censadas</p>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-16 h-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 wire:model.live="defunciones" class="ml-2 text-6xl font-bold text-gray-900">{{$defunciones}}</h3>
                        </div>
                        <p class="mt-6 text-base text-gray-600 md:max-w-xs">Defunciones registradas</p>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-16 h-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 wire:model.live="matrimonios" class="ml-2 text-6xl font-bold text-gray-900">{{$matrimonios}}</h3>
                        </div>
                        <p class="mt-6 text-base text-gray-600 md:max-w-xs">Matrimonios registrados</p>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-16 h-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 wire:model.live="nacimientos" class="ml-2 text-6xl font-bold text-gray-900">{{$nacimientos}}</h3>
                        </div>
                        <p class="mt-6 text-base text-gray-600 md:max-w-xs">Nacimientos registrados</p>
                    </div>
                </div>

                <!-- Resto del contenido permanece igual -->
            </div>
        </div>
    </section>

</div>


