<div class="max-w-4xl mx-auto p-6">
    <div class="w-full bg-gray-900 text-white rounded-2xl shadow-lg p-6 border border-gray-700">
        <form wire:submit.prevent="guardarPersona" class="space-y-6">
            <h2 class="text-2xl font-bold border-b border-gray-700 pb-3">Tus datos personales</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-300 mb-1">DNI</label>
                    <input wire:model="dni" type="text" id="dni"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                    @error('dni') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-300 mb-1">Nombres y Apellidos</label>
                    <input wire:model="nombre" type="text" id="nombre"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                    @error('nombre') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-300 mb-1">Fecha de Nacimiento</label>
                    <input wire:model="fecha_nacimiento" type="date" id="fecha_nacimiento"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                    @error('fecha_nacimiento') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-300 mb-1">Sexo</label>
                    <select wire:model="sexo" id="sexo"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        disabled>
                        <option value="">Seleccione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    @error('sexo') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="lugar" class="block text-sm font-medium text-gray-300 mb-1">Domicilio</label>
                    <select wire:model="lugar" id="lugar"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        disabled required>
                        <option value="{{ $lugar->id }}">
                            {{ $lugar->distrito }}, {{ $lugar->provincia }}, {{ $lugar->departamento }}, {{ $lugar->pais }}
                        </option>
                    </select>
                    @error('lugar') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-300 mb-1">Teléfono</label>
                    <input wire:model="telefono" type="text" id="telefono" maxlength="9"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('telefono') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-6 text-right">
                <button disabled type="submit"
                    class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition duration-300 cursor-not-allowed">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
