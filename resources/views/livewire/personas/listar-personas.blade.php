<div>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <!-- head -->
            <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($personas as $persona)
                <tr class="hover:bg-emerald-200 text-gray-900">
                    <td>{{ $persona->dni }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido }}</td>
                    <td>{{ $persona->fecha_nacimiento }}</td>
                    <td>
                        <button class="btn btn-xs bg-emerald-500 text-white hover:bg-emerald-600">JORGITO</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
