<div class="text-black">
    <button class="rounded bg-gray-800 px-4 py-2 mb-4">
    <a href="{{ route('actas-nacimiento-create') }}" wire:navigate class="text-green-600 font-semibold">
        Registrar acta
    </a>
    </button>
    <livewire:actas.acta-nacimiento.listar-nacimiento lazy />
</div>



