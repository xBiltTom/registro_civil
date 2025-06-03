<div>
    <div class="overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Pobladores de Chicama
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran todos los pobladores censados actualmente</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            DNI
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Apellido
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Accion</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$persona->dni}}
                        </th>
                        <td class="px-6 py-4">
                            {{$persona->nombre}}
                        </td>
                        <td class="px-6 py-4">
                            {{$persona->apellido}}
                        </td>
                        <td class="px-6 py-4">
                            ({{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años)
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form wire:submit="borrar({{$persona->id}})">
                                <a  class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button wire:model="usuario" type="submit">
                                    Borrar
                                </button>

                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </div>

        <div class="mt-4">
            {{ $personas->links() }}
        </div>

</div>
