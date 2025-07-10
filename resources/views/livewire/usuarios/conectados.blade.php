<div>
    @php
        $conectado = DB::table('sessions')->where('user_id', $usuario->id)->exists();
    @endphp
    <span wire:key="{{$usuario->id}}" wire:poll.2s class="{{ $conectado ? 'text-green-500' : 'text-gray-400' }}">
        {{ $conectado ? 'Conectado' : 'Desconectado' }}
    </span>
</div>
