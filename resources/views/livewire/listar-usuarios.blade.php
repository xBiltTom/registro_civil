
<div class="text-gray-900">
    <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>
    <ul class="space-y-1">
        @foreach ($usuarios as $usuario)
            <li>{{ $usuario->nombre }}</li>
        @endforeach
    </ul>
</div>

