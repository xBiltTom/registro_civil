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
                <div class="alert alert-info">
                    <strong>Información:</strong> Esta acta es de tipo "Nacimientos".
                </div>
            @endif

            @if($acta->tipo_id == 2)
                <div class="alert alert-info">
                    <strong>Información:</strong> Esta acta es de tipo "Matrimonios".
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

                {{-- <a href="{{route('defunciones-pdf',['id'=>$id_acta])}}">
                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white rounded-md px-6 py-2 transition-all duration-200">
                        Descargar acta
                    </button>
                </a> --}}

                <div x-data="{ showAlert: false }">
                    <!-- Botón para disparar la alerta -->
                    <button type="button" @click="showAlert = true" class="bg-yellow-400 hover:bg-yellow-700 text-black rounded-md px-6 py-2 transition-all duration-200">
                        Solicitar acta
                    </button>

                    <!-- Alerta -->
                    <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                            <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro?</h2>
                            <p class="text-gray-600 mt-2">Se enviará la solicitud</p>
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

        </div>
    </div>

</div>
