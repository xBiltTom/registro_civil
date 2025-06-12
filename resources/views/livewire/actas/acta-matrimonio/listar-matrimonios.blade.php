<div>
    <div class="overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Actas de Matrimonio
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Se muestran todas las actas de matrimonio registradas actualmente
                    </p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Novio</th>
                        <th scope="col" class="px-6 py-3">Novia</th>
                        <th scope="col" class="px-6 py-3">Fecha</th>
                        <th scope="col" class="px-6 py-3">Testigo 1</th>
                        <th scope="col" class="px-6 py-3">Testigo 2</th>
                        <th scope="col" class="px-6 py-3">Acta</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Acción</span></th>
                    </tr>
                </thead>
                <tbody>
    @foreach($matrimonios as $matrimonio)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $matrimonio->acta_id }}
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
        <td class="px-6 py-4">
            {{ $matrimonio->acta->id ?? 'Sin datos' }}
        </td>
        <td class="px-6 py-4 text-right">
            <button wire:click="editar({{ $matrimonio->acta_id }})" class="text-blue-600 hover:underline mr-2">Editar</button>
            <button wire:click="eliminar({{ $matrimonio->acta_id }})" class="text-red-600 hover:underline">Eliminar</button>
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