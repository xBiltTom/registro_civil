<div class="overflow-auto" style="max-height: 340px;">
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        @if($nacimientos->count())
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Acta</th>
                <th scope="col" class="px-6 py-3">Libro</th>
                <th scope="col" class="px-6 py-3">Folio</th>
                <th scope="col" class="px-6 py-3">Nacido</th>
                <th scope="col" class="px-6 py-3">Fecha de Registro</th>
                <th scope="col" class="px-6 py-3">Fecha de Nacimiento</th>
                <th scope="col" class="px-6 py-3">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nacimientos as $nacimiento)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $nacimiento->acta_id }}
                </th>
                <td class="px-6 py-4">
                    {{ $nacimiento->acta->folio->libro_id ?? 'N/A' }}
                </td>
                <td class="px-6 py-4">
                    {{ $nacimiento->acta->folio_id ?? 'N/A' }}
                </td>
                <td class="px-6 py-4">
                    {{ $nacimiento->nombre_nacido }} {{ $nacimiento->apellido_nacido }}
                </td>
                <td class="px-6 py-4">
                    {{ $nacimiento->acta->fecha_registro ?? 'N/A' }}
                </td>
                <td class="px-6 py-4">
                    {{ $nacimiento->fecha_nacimiento }}
                </td>
                <td class="px-6 py-4 text-right">
                    <form wire:submit.prevent="eliminar({{ $nacimiento->acta_id}})">
                        <a href="{{ route('actas-nacimiento-edit', ['id' => $nacimiento->acta_id]) }}" wire:navigate class="font-medium p-2 text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Editar acta</a>
                        <button type="submit" class="font-medium p-2 text-red-600 dark:text-red-500 hover:underline cursor-pointer">
                            Borrar acta
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
            <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <div class="flex justify-between">
                    <div>
                        No se encontraron actas de nacimiento
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">No hay registros disponibles actualmente</p>
                    </div>
                </div>
            </div>
        @endif
    </table>
</div>
<div class="mt-4">
    {{ $nacimientos->links() }}
</div>
