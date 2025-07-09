<div wire:poll.2s="cargarSolicitudesPendientes">
    @if($solicitudesPendientes > 0)
        <span class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-white bg-red-500 rounded-full">
            {{ $solicitudesPendientes }}
        </span>
        {{-- @script

            <script>
                alert('Funcionando');
            </script>

        @endscript --}}
    @endif
</div>
