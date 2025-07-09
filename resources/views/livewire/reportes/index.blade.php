<div>
    <div class="relative shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="flex justify-between">
                <div>
                    Generador de reportes
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Filtrar datos por entidades y fechas</p>
                </div>
                <div>
                    <a href="{{route('personas.create')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar persona</button></a>
                </div>
            </div>

        </div>

        <!-- Sección de filtros para reportes -->
        <div class="p-5 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Configuración de reportes</h3>

            <div class="mb-6">
                <h4 class="mb-3 text-md font-medium text-gray-700 dark:text-gray-300">Reportes específicos</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Reporte de Nacimientos -->
                    <div class="p-4 border border-green-200 dark:border-green-700 rounded-lg bg-green-50 dark:bg-green-900">
                        <div class="flex items-center mb-3">
                            <input wire:model="reportesEspecificos.nacidos" type="checkbox" id="reporte-nacidos" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                            <label for="reporte-nacidos" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reporte de Nacimientos</label>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Genera un informe detallado de personas registradas con actas de nacimiento.</p>
                        <div class="ms-6 space-y-2" x-show="$wire.reportesEspecificos.nacidos">
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.nacidos.conPadres" type="checkbox" id="nacidos-padres" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                                <label for="nacidos-padres" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Con datos de padres</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.nacidos.porAnio" type="checkbox" id="nacidos-anio" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                                <label for="nacidos-anio" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Agrupar por año</label>
                            </div>
                        </div>
                    </div>

                    <!-- Reporte de Matrimonios -->
                    <div class="p-4 border border-blue-200 dark:border-blue-700 rounded-lg bg-blue-50 dark:bg-blue-900">
                        <div class="flex items-center mb-3">
                            <input wire:model="reportesEspecificos.casados" type="checkbox" id="reporte-casados" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="reporte-casados" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reporte de Matrimonios</label>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Genera un informe detallado de matrimonios registrados.</p>
                        <div class="ms-6 space-y-2" x-show="$wire.reportesEspecificos.casados">
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.casados.conTestigos" type="checkbox" id="casados-testigos" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="casados-testigos" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Con datos de testigos</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.casados.porAnio" type="checkbox" id="casados-anio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="casados-anio" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Agrupar por año</label>
                            </div>
                        </div>
                    </div>

                    <!-- Reporte de Defunciones -->
                    <div class="p-4 border border-red-200 dark:border-red-700 rounded-lg bg-red-50 dark:bg-red-900">
                        <div class="flex items-center mb-3">
                            <input wire:model="reportesEspecificos.fallecidos" type="checkbox" id="reporte-fallecidos" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                            <label for="reporte-fallecidos" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reporte de Defunciones</label>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Genera un informe detallado de fallecimientos registrados.</p>
                        <div class="ms-6 space-y-2" x-show="$wire.reportesEspecificos.fallecidos">
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.fallecidos.conCausa" type="checkbox" id="fallecidos-causa" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                                <label for="fallecidos-causa" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Con causa de muerte</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtrosEspecificos.fallecidos.porAnio" type="checkbox" id="fallecidos-anio" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                                <label for="fallecidos-anio" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Agrupar por año</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Acordeón de filtros -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Selección de entidades -->
                <div>
                    <h4 class="mb-2 text-md font-medium text-gray-700 dark:text-gray-300">Entidades</h4>

                    <!-- Personas -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <input wire:model="entidades.personas" type="checkbox" id="filtro-personas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="filtro-personas" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Usuarios</label>
                        </div>
                        <div class="ms-6 space-y-2" x-show="$wire.entidades.personas">
                            <div class="flex items-center">
                                <input wire:model="filtros.personas.funcionarios" type="checkbox" id="filtro-funcionarios" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-funcionarios" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Funcionarios</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.personas.administradores" type="checkbox" id="filtro-administradores" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-administradores" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Administradores</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.personas.usuarios" type="checkbox" id="filtro-usuarios" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-usuarios" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Usuarios normales</label>
                            </div>
                        </div>
                    </div>

                    <!-- Actas -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <input wire:model="entidades.actas" type="checkbox" id="filtro-actas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="filtro-actas" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Actas</label>
                        </div>
                        <div class="ms-6 space-y-2" x-show="$wire.entidades.actas">
                            <div class="flex items-center">
                                <input wire:model="filtros.actas.nacimiento" type="checkbox" id="filtro-nacimiento" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-nacimiento" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Nacimiento</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.actas.matrimonio" type="checkbox" id="filtro-matrimonio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-matrimonio" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Matrimonio</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.actas.defuncion" type="checkbox" id="filtro-defuncion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-defuncion" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Defunción</label>
                            </div>
                        </div>
                    </div>

                    <!-- Libros -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <input wire:model="entidades.libros" type="checkbox" id="filtro-libros" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="filtro-libros" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Libros</label>
                        </div>
                    </div>

                    <!-- Solicitudes -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <input wire:model="entidades.solicitudes" type="checkbox" id="filtro-solicitudes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="filtro-solicitudes" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Solicitudes</label>
                        </div>
                        <div class="ms-6 space-y-2" x-show="$wire.entidades.solicitudes">
                            <div class="flex items-center">
                                <input wire:model="filtros.solicitudes.pendientes" type="checkbox" id="filtro-pendientes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-pendientes" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Pendientes</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.solicitudes.aprobadas" type="checkbox" id="filtro-aprobadas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-aprobadas" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Aprobadas</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.solicitudes.rechazadas" type="checkbox" id="filtro-rechazadas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="filtro-rechazadas" class="ms-2 text-xs font-medium text-gray-700 dark:text-gray-400">Rechazadas</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros adicionales y rangos de fechas -->
                <div>
                    <h4 class="mb-2 text-md font-medium text-gray-700 dark:text-gray-300">Filtros adicionales</h4>

                    <!-- Rango de fechas -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <label for="fecha-desde" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rango de fechas</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="fecha-desde" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-400">Desde</label>
                                <input wire:model="filtros.fechaDesde" type="date" id="fecha-desde" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="fecha-hasta" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-400">Hasta</label>
                                <input wire:model="filtros.fechaHasta" type="date" id="fecha-hasta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Ordenamiento -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <label for="ordenar-por" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ordenar por</label>
                        <select wire:model="filtros.ordenarPor" id="ordenar-por" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="fecha_desc">Fecha (más reciente primero)</option>
                            <option value="fecha_asc">Fecha (más antigua primero)</option>
                            <option value="nombre_asc">Nombre (A-Z)</option>
                            <option value="nombre_desc">Nombre (Z-A)</option>
                        </select>
                    </div>

                    <!-- Formato de salida -->
                    <div class="mb-3 p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Formato de reporte</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input wire:model="filtros.formato" type="radio" value="pdf" id="formato-pdf" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="formato-pdf" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">PDF</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.formato" type="radio" value="excel" id="formato-excel" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="formato-excel" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Excel</label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="filtros.formato" type="radio" value="csv" id="formato-csv" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="formato-csv" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CSV</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end mt-4 space-x-3">
                <button wire:click="limpiarFiltros" type="button" class="py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Limpiar filtros
                </button>
                <button wire:click="generarReporte" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Generar reporte
                </button>
            </div>
        </div>

        <div class="overflow-auto" style="max-height: 340px;">
            <!-- ...existing code... -->
    </div>
    {{-- <div class="mt-2">
        {{ $personas->links() }}
    </div> --}}
    <!-- Agregar después del div principal en index.blade.php -->
    @if(session()->has('mensaje'))
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
            {{ session('mensaje') }}
        </div>
    @endif

</div>
