
<div>
    <div>
        <a href="{{route('personal')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Volver</button></a>
    </div>

    <div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos del Acta</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="acta" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">N° de Acta</label>
                    <input disabled  value="{{$acta->id}}" type="text" id="acta" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div>
                    <label for="libro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Libro</label>
                    <input disabled value="{{$acta->folio->libro_id}}" type="text" id="libro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div>
                    <label for="folio" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Folio</label>
                    <input disabled value="{{$acta->folio->id}}" type="text" id="folio" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
            </div>

            <div>
                <label for="fecha_registro" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Registro</label>

                <input disabled value="{{$acta->fecha_registro}}" type="date" id="fecha_registro" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>

            </div>

            @if($acta->tipo_id == 1)
                <h2 class="text-white font-bold text-lg mb-4">Datos del Nacido</h2>
                <div class="grid grid-cols-1 gap-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="nombre_nacido">Nombre del Nacido</label>
                        <input
                            name="nombre_nacido"
                            value="{{ $acta->actaNacimiento->nacido->nombre }} {{ $acta->actaNacimiento->nacido->apellido }}"
                            id="nombre_nacido"
                            class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                    </div>
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input
                            name="fecha_nacimiento"
                            value="{{ $acta->actaNacimiento->nacido->fecha_nacimiento }}"
                            id="fecha_nacimiento"
                            class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2"
                            type="text"
                            readonly>
                    </div>
                </div>

                <h2 class="text-white font-bold text-lg mb-4">Datos de los Padres</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="madre">Nombre de la Madre</label>
                        <div class="flex">
                            <input
                                name="madre"
                                value="{{ $acta->actaNacimiento->madre->nombre }} {{ $acta->actaNacimiento->madre->apellido }}"
                                id="madre"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                                <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                    <svg id="Icons_Baby" width="24" height="24" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="48" cy="20.5" r="12.5" />
                                        <path d="M57 62.5 C57 62.6 57 62.7 57 62.8 C53.5 63.1 50.9 66 51 69.5 C51 70.5 51.3 71.5 51.8 72.3 C50.7 72.7 49.3 72.9 47.8 72.9 C46.2 72.9 44.9 72.7 43.9 72.3 C45.4 70.1 45.4 67.1 43.8 64.8 C42.6 63.2 40.9 62.2 39 62 L39 60 L57 60 L57 62.5 Z M76.2 44.2 L59 35.2 C58.6 35.1 58.2 35 57.8 35 L39 35 C38.5 35 38.1 35.1 37.6 35.2 L19.6 45.2 C17.5 46 16.5 48.3 17.2 50.3 C17.8 52 19.4 53 21 53 C21.5 53 21.9 52.9 22.4 52.8 L35 46.2 C35 46.2 35 62.7 35 63 C34.8 63.1 26.8 68.7 26.8 68.7 C25.1 69.9 24.6 72.3 25.7 74.1 L32.7 85.1 C33.9 87 36.4 87.5 38.2 86.3 C40 85.1 40.6 82.6 39.4 80.8 L36 75.3 L38.2 75.3 C38.9 75.3 39.6 75.2 40.3 75 C42.1 76.2 44.5 76.9 47.7 76.9 C50.7 76.9 53.1 76.2 55 75.2 C55.8 75.6 56.8 75.7 57.8 75.7 L59.6 75.6 L56 80.6 C54.7 82.4 55.1 84.9 56.9 86.2 C58.7 87.5 61.2 87.1 62.5 85.3 L70.5 74.3 C70.6 74.2 70.7 74.1 70.7 73.9 C71.8 72 71.1 69.5 69.2 68.4 L61 63.8 C61 63.4 61 45.8 61 45.8 L73.8 51.9 C74.2 52 74.6 52.1 75 52.1 C76.7 52.1 78.3 51 78.8 49.3 C79.5 47.1 78.3 44.9 76.2 44.2 Z" />
                                    </svg>
                                </button>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="padre">Nombre del Padre</label>
                        <div class="flex">
                            <input
                                name="padre"
                                value="{{ $acta->actaNacimiento->padre->nombre ?? 'No registrado' }} {{ $acta->actaNacimiento->padre->apellido ?? '' }}"
                                id="padre"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                                <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                    <svg id="Icons_Baby" width="24" height="24" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="48" cy="20.5" r="12.5" />
                                        <path d="M57 62.5 C57 62.6 57 62.7 57 62.8 C53.5 63.1 50.9 66 51 69.5 C51 70.5 51.3 71.5 51.8 72.3 C50.7 72.7 49.3 72.9 47.8 72.9 C46.2 72.9 44.9 72.7 43.9 72.3 C45.4 70.1 45.4 67.1 43.8 64.8 C42.6 63.2 40.9 62.2 39 62 L39 60 L57 60 L57 62.5 Z M76.2 44.2 L59 35.2 C58.6 35.1 58.2 35 57.8 35 L39 35 C38.5 35 38.1 35.1 37.6 35.2 L19.6 45.2 C17.5 46 16.5 48.3 17.2 50.3 C17.8 52 19.4 53 21 53 C21.5 53 21.9 52.9 22.4 52.8 L35 46.2 C35 46.2 35 62.7 35 63 C34.8 63.1 26.8 68.7 26.8 68.7 C25.1 69.9 24.6 72.3 25.7 74.1 L32.7 85.1 C33.9 87 36.4 87.5 38.2 86.3 C40 85.1 40.6 82.6 39.4 80.8 L36 75.3 L38.2 75.3 C38.9 75.3 39.6 75.2 40.3 75 C42.1 76.2 44.5 76.9 47.7 76.9 C50.7 76.9 53.1 76.2 55 75.2 C55.8 75.6 56.8 75.7 57.8 75.7 L59.6 75.6 L56 80.6 C54.7 82.4 55.1 84.9 56.9 86.2 C58.7 87.5 61.2 87.1 62.5 85.3 L70.5 74.3 C70.6 74.2 70.7 74.1 70.7 73.9 C71.8 72 71.1 69.5 69.2 68.4 L61 63.8 C61 63.4 61 45.8 61 45.8 L73.8 51.9 C74.2 52 74.6 52.1 75 52.1 C76.7 52.1 78.3 51 78.8 49.3 C79.5 47.1 78.3 44.9 76.2 44.2 Z" />
                                    </svg>
                                </button>
                        </div>
                    </div>
                </div>

                <h2 class="text-white font-bold text-lg mb-4">Lugar de Nacimiento</h2>
                <div class="mb-6">
                    <label class="text-white block mb-1" for="lugar_nacimiento">Lugar</label>
                    <input
                        name="lugar_nacimiento"
                        value="{{ $acta->actaNacimiento->nacido->lugar->distrito }}"
                        id="lugar_nacimiento"
                        class="w-full bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2"
                        type="text"
                        readonly>
                </div>
            @endif

            @if($acta->tipo_id == 2)
                <h2 class="text-white font-bold text-lg mb-4">Datos del Matrimonio</h2>

                <!-- Búsqueda de Novio -->
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="novio">Novio</label>
                        <div class="flex">
                            <input
                                name="novio"
                                value="{{$acta->actaMatrimonio->novio->nombre}} {{$acta->actaMatrimonio->novio->apellido}}"
                                id="novio"

                                placeholder="Buscar Novio"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M228.12,145.14,192,123.47V104a8,8,0,0,0-4-7L136,67.36V48h16a8,8,0,0,0,0-16H136V16a8,8,0,0,0-16,0V32H104a8,8,0,0,0,0,16h16V67.36L68,97.05a8,8,0,0,0-4,7v19.47L27.88,145.14A8,8,0,0,0,24,152v64a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V168a8,8,0,0,1,16,0v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V152A8,8,0,0,0,228.12,145.14ZM40,156.53l24-14.4V208H40ZM128,144a24,24,0,0,0-24,24v40H80V108.64l48-27.43,48,27.43V208H152V168A24,24,0,0,0,128,144Zm88,64H192V142.13l24,14.4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Búsqueda de Novia -->
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="novia">Novia</label>
                        <div class="flex">
                            <input
                                name="novia"
                                value="{{$acta->actaMatrimonio->novia->nombre}} {{$acta->actaMatrimonio->novia->apellido}}"
                                id="novia"

                                placeholder="Buscar Novia"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M228.12,145.14,192,123.47V104a8,8,0,0,0-4-7L136,67.36V48h16a8,8,0,0,0,0-16H136V16a8,8,0,0,0-16,0V32H104a8,8,0,0,0,0,16h16V67.36L68,97.05a8,8,0,0,0-4,7v19.47L27.88,145.14A8,8,0,0,0,24,152v64a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V168a8,8,0,0,1,16,0v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V152A8,8,0,0,0,228.12,145.14ZM40,156.53l24-14.4V208H40ZM128,144a24,24,0,0,0-24,24v40H80V108.64l48-27.43,48,27.43V208H152V168A24,24,0,0,0,128,144Zm88,64H192V142.13l24,14.4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="fecha_matrimonio">Fecha de Matrimonio</label>
                        <div class="flex">
                            <input readonly type="text" id="fecha_matrimonio" name="fecha_matrimonio" value="{{ \Carbon\Carbon::parse($acta->actaMatrimonio->fecha_matrimonio)->format('d/m/Y') }}"
                            class="flex-1 bg-gray-800 rounded-md border-gray-700 text-white px-3 py-2"
                            >
                            <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M228.12,145.14,192,123.47V104a8,8,0,0,0-4-7L136,67.36V48h16a8,8,0,0,0,0-16H136V16a8,8,0,0,0-16,0V32H104a8,8,0,0,0,0,16h16V67.36L68,97.05a8,8,0,0,0-4,7v19.47L27.88,145.14A8,8,0,0,0,24,152v64a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V168a8,8,0,0,1,16,0v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V152A8,8,0,0,0,228.12,145.14ZM40,156.53l24-14.4V208H40ZM128,144a24,24,0,0,0-24,24v40H80V108.64l48-27.43,48,27.43V208H152V168A24,24,0,0,0,128,144Zm88,64H192V142.13l24,14.4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Búsqueda de Testigo 1 -->
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="testigo1">Testigo 1</label>
                        <div class="flex">
                            <input
                                name="testigo1"
                                value="{{$acta->actaMatrimonio->testigo1->nombre}} {{$acta->actaMatrimonio->testigo1->apellido}}"
                                id="testigo1"

                                placeholder="Buscar Testigo 1"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M228.12,145.14,192,123.47V104a8,8,0,0,0-4-7L136,67.36V48h16a8,8,0,0,0,0-16H136V16a8,8,0,0,0-16,0V32H104a8,8,0,0,0,0,16h16V67.36L68,97.05a8,8,0,0,0-4,7v19.47L27.88,145.14A8,8,0,0,0,24,152v64a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V168a8,8,0,0,1,16,0v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V152A8,8,0,0,0,228.12,145.14ZM40,156.53l24-14.4V208H40ZM128,144a24,24,0,0,0-24,24v40H80V108.64l48-27.43,48,27.43V208H152V168A24,24,0,0,0,128,144Zm88,64H192V142.13l24,14.4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Búsqueda de Testigo 2 -->
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="testigo2">Testigo 2</label>
                        <div class="flex">
                            <input
                                name="testigo2"
                                value="{{$acta->actaMatrimonio->testigo2->nombre}} {{$acta->actaMatrimonio->testigo2->apellido}}"
                                id="testigo2"

                                placeholder="Buscar Testigo"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" class="bg-gray-600 hover:bg-gray-300 text-white hover:text-black px-4 py-2 rounded-r-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M228.12,145.14,192,123.47V104a8,8,0,0,0-4-7L136,67.36V48h16a8,8,0,0,0,0-16H136V16a8,8,0,0,0-16,0V32H104a8,8,0,0,0,0,16h16V67.36L68,97.05a8,8,0,0,0-4,7v19.47L27.88,145.14A8,8,0,0,0,24,152v64a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V168a8,8,0,0,1,16,0v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V152A8,8,0,0,0,228.12,145.14ZM40,156.53l24-14.4V208H40ZM128,144a24,24,0,0,0-24,24v40H80V108.64l48-27.43,48,27.43V208H152V168A24,24,0,0,0,128,144Zm88,64H192V142.13l24,14.4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif


            @if($acta->tipo_id == 3)
                <h2 class="text-white font-bold text-lg mb-4">Datos del Fallecido</h2>

                <!-- Búsqueda de fallecido -->
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="fallecido">Fallecido</label>
                        <div class="flex">
                            <input
                                name="fallecido"
                                value="{{$acta->actaDefuncion->fallecido->nombre}} {{$acta->actaDefuncion->fallecido->apellido}}"
                                id="fallecido"

                                placeholder="Buscar fallecido"
                                class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2"
                                type="text"
                                readonly>
                            <button type="button" class="bg-gray-600 hover:bg-white text-white px-4 py-2 rounded-r-md">
                                <svg width="" height="30px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M31.9618 3.95146L15.9618 3.96457L10.9724 16.9687L15.9945 43.9646L31.9945 43.9515L36.9724 16.9474L31.9618 3.95146ZM22.9798 25.9588L22.9737 18.4588L19.9737 18.4613L19.9721 16.4613L22.9721 16.4588L22.9692 12.9588L24.9692 12.9572L24.9721 16.4572L27.9721 16.4547L27.9737 18.4547L24.9737 18.4572L24.9798 25.9572L22.9798 25.9588Z" fill="#333333"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <h2 class="text-white font-bold text-lg mb-4">Datos del Declarante</h2>
                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="declarante">Declarante</label>
                        <div class="flex">
                            <input name="declarante" value="{{$acta->actaDefuncion->declarante->nombre}} {{$acta->actaDefuncion->declarante->apellido}}" id="declarante"

                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2" type="text" readonly>
                            <button type="button"  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">
                                <svg width="" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 22C1 21.4477 1.44772 21 2 21H22C22.5523 21 23 21.4477 23 22C23 22.5523 22.5523 23 22 23H2C1.44772 23 1 22.5523 1 22Z" fill="#0F0F0F"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3056 1.87868C17.1341 0.707107 15.2346 0.707107 14.063 1.87868L3.38904 12.5526C2.9856 12.9561 2.70557 13.4662 2.5818 14.0232L2.04903 16.4206C1.73147 17.8496 3.00627 19.1244 4.43526 18.8069L6.83272 18.2741C7.38969 18.1503 7.89981 17.8703 8.30325 17.4669L18.9772 6.79289C20.1488 5.62132 20.1488 3.72183 18.9772 2.55025L18.3056 1.87868ZM15.4772 3.29289C15.8677 2.90237 16.5009 2.90237 16.8914 3.29289L17.563 3.96447C17.9535 4.35499 17.9535 4.98816 17.563 5.37868L15.6414 7.30026L13.5556 5.21448L15.4772 3.29289ZM12.1414 6.62869L4.80325 13.9669C4.66877 14.1013 4.57543 14.2714 4.53417 14.457L4.0014 16.8545L6.39886 16.3217C6.58452 16.2805 6.75456 16.1871 6.88904 16.0526L14.2272 8.71448L12.1414 6.62869Z" fill="#0F0F0F"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="flex flex-row space-x-4 mb-6">
                    <div class="flex-1">
                        <label class="text-white block mb-1" for="detalle">Detalles del fallecimiento</label>
                        <div class="flex">
                            <textarea readonly name="detalle"  id="detalle"
                            class="flex-1 bg-gray-800 rounded-l-md border-gray-700 text-white px-3 py-2" type="text" >{{$acta->actaDefuncion->detalle}}
                            </textarea>
                        </div>
                    </div>
                </div>

            @endif

            <div class="mt-6 flex justify-between">

                @if($descargar==1)
                    <a
                        @if($acta->tipo_id == 1)
                            href="{{ route('nacimientos-pdf', ['id' =>
                            $acta->id]) }}"
                        @elseif($acta->tipo_id == 2)
                            href="{{ route('matrimonios-pdf', ['id' => $acta->id]) }}"
                        @elseif($acta->tipo_id == 3)
                            href="{{ route('defunciones-pdf', ['id' => $acta->id]) }}"
                        @endif

                    >
                        <button type="button" class="bg-red-600 hover:bg-red-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                            Descargar acta
                        </button>
                    </a>
                @else
                    <button wire:navigate href="{{route('solicitudes.personal.registrar',['id'=>$acta->id])}}" {{-- @click="showAlert = true" --}} class="bg-yellow-400 hover:bg-yellow-700 text-black rounded-md px-6 py-2 transition-all duration-200">
                        Solicitar acta
                    </button>
                @endif

            </div>

        </div>
    </div>

</div>

{{-- @script
    @if(session('error'))
        <script>
            alert('{{ session('error') }}');
            Swal.fire({
            title: 'Éxito',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
        </script>
    @endif

@endscript --}}
