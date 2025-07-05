<div>
    <div class="overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between">
                        <div>
                            Actas de Matrimonio
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran todas las actas de matrimonio registradas actualmente</p>
                        </div>
                        <div>
                            <a href="{{route('r-a-m')}}" wire:navigate><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar acta</button></a>
                        </div>
                    </div>
                </div>


                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Acta</th>
                        <th scope="col" class="px-6 py-3">Novio</th>
                        <th scope="col" class="px-6 py-3">Novia</th>
                        <th scope="col" class="px-6 py-3">Fecha</th>
                        <th scope="col" class="px-6 py-3">Testigo 1</th>
                        <th scope="col" class="px-6 py-3">Testigo 2</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Acción</span></th>
                    </tr>
                </thead>
                <tbody>
    @foreach($matrimonios as $matrimonio)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $matrimonio->acta_id ?? 'Sin datos' }}
        </th>
        <td class="px-6 py-4">
            {{ $matrimonio->novio ? $matrimonio->novio->nombre . ' ' . $matrimonio->novio->apellido : 'Sin datos' }}
        </td>
        <td class="px-6 py-4">
            {{ $matrimonio->novia ? $matrimonio->novia->nombre . ' ' . $matrimonio->novia->apellido : 'Sin datos' }}
        </td>
        <td class="px-6 py-4">
            {{ $matrimonio->fecha_matrimonio }}
        </td>
        <td class="px-6 py-4">
            {{ $matrimonio->testigo1 ? $matrimonio->testigo1->nombre . ' ' . $matrimonio->testigo1->apellido : 'Sin datos' }}
        </td>
        <td class="px-6 py-4">
            {{ $matrimonio->testigo2 ? $matrimonio->testigo2->nombre . ' ' . $matrimonio->testigo2->apellido : 'Sin datos' }}
        </td>
        <td class="px-6 py-4 flex justify-center space-x-4 items-center">
            {{-- <button wire:click="editar({{ $matrimonio->acta_id }})" class="text-blue-600 hover:underline mr-2">Editar</button> --}}
            <a wire:navigate href="{{route('acta-matrimonio.editar',["id"=>$matrimonio->acta_id])}}" class="text-blue-600 hover:underline mr-2">Editar</a>
            <div x-data="{ showAlert: false }" class="relative">
                <button type="button" @click="showAlert = true" class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer"> Eliminar acta </button>
                <!-- Modal de confirmación -->
                <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                        <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro?</h2>
                        <p class="text-gray-600 mt-2">No podrás revertir esta acción.</p>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showAlert = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md"> Cancelar </button>
                            <form wire:submit.prevent="eliminar({{ $matrimonio->acta_id }})">
                                <button type="submit" @click="showAlert = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md"> Confirmar </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $matrimonios->links() }}
    </div>
</div>
