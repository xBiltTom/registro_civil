<div class="text-black">
    <div class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
        <div class="flex justify-between">
            <div>
                Actas de Nacimiento
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Se muestran las actas de nacimiento registradas actualmente</p>
            </div>
            <div>
                <a href="{{ route('actas-nacimiento-create') }}" wire:navigate>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Registrar acta
                    </button>
                </a>
            </div>
        </div>
    </div>
    <livewire:actas.acta-nacimiento.listar-nacimiento lazy />
</div>
