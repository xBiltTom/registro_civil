<div class="w-full p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md">
    <form wire:submit.prevent="guardarPersona" class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-2">Datos de la Persona</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="dni" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">DNI</label>
                <input wire:model="dni" type="text" id="dni" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                @error('dni') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="nombre" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input wire:model="nombre" type="text" id="nombre" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="apellido" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Apellido</label>
                <input wire:model="apellido" type="text" id="apellido" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                @error('apellido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="sexo" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Sexo</label>
                <select wire:model="sexo" id="sexo" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Seleccione...</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                @error('sexo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_nacimiento" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha de Nacimiento</label>
                <input wire:model="fecha_nacimiento" type="date" id="fecha_nacimiento" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                @error('fecha_nacimiento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="lugar_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Lugar de Nacimiento</label>
                <select wire:model="lugar_id" id="lugar_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Seleccione un lugar...</option>
                    @foreach($lugares as $lugar)
                        <option value="{{ $lugar->id }}">
                            {{ $lugar->distrito }}, {{ $lugar->provincia }}, {{ $lugar->departamento }}, {{ $lugar->pais }}
                        </option>
                    @endforeach
                </select>
                @error('lugar_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="telefono" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                <input wire:model="telefono" type="text" id="telefono" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" maxlength="9" required>
                @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="pt-6 text-right">
            <button type="button" wire:click="resetForm" class="px-6 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg dark:bg-gray-600 dark:hover:bg-gray-700">
                Cancelar
            </button>
            <button type="submit" class="px-6 py-2 text-white bg-gray-700 hover:bg-gray-800 rounded-lg dark:bg-gray-600 dark:hover:bg-gray-700">
                Registrar Persona
            </button>
        </div>
    </form>
</div>
