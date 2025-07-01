<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Persona;
use App\Models\ActaDefuncion;

new #[Layout('layouts.guest')] class extends Component
{
    public string $dni = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void {
        $validated = $this->validate([
            'dni' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buscar a la persona por DNI
        $persona = Persona::where('dni', $validated['dni'])->first();

        if (!$persona) {
            $this->addError('dni', 'No se encontró una persona con este DNI.');
            return;
        }

        // Depuración: Verificar el valor de fallecido_id
        \Log::info('Persona encontrada', ['fallecido_id' => $persona->fallecido_id]);

        // Para verificar si la persona está muertita
        $actaDefuncion = ActaDefuncion::where('fallecido_id', $persona->id)->first();

        if ($actaDefuncion) {
            $this->addError('dni', 'No puedes registrarte porque esta persona está registrada como fallecida.');
            return;
        }

        // Verificar si es mayor de 18 años
        if (\Carbon\Carbon::parse($persona->fecha_nacimiento)->age < 18) {
            $this->addError('dni', 'Debes ser mayor de 18 años para registrarte.');
            return;
        }

        // Verificar si la persona ya tiene un usuario asociado
        $existingUser = User::where('persona_id', $persona->id)->first();

        if ($existingUser) {
            $this->addError('dni', 'Esta persona ya tiene un usuario registrado.');
            return;
        }

        // Asociar la persona al usuario y registrar
        $validated['persona_id'] = $persona->id;
        $validated['name'] = 'usuario ' . $persona->nombre;
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-[90%] max-w-[380px] bg-black/70 text-gray-200 rounded-xl p-8 shadow-xl z-10 text-center mx-auto">
    <p class="text-xl sm:text-2xl font-semibold mb-2 text-gray-100">Registro</p>
    <hr class="border-gray-700 mb-6">

    <form wire:submit="register">
        <!-- DNI -->
        <div class="mb-4 text-left">
            <x-input-label for="dni" :value="__('DNI')" class="text-gray-300" />
            <x-text-input wire:model="dni" id="dni" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-gray-500 focus:ring-gray-500" type="text" name="dni" required autofocus autocomplete="dni" />
            <x-input-error :messages="$errors->get('dni')" class="mt-2 text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mb-4 text-left">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-gray-500 focus:ring-gray-500" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mb-4 text-left">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-300" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-gray-500 focus:ring-gray-500" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 text-left">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-300" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-gray-500 focus:ring-gray-500" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex flex-col items-center justify-center mt-6 gap-4">
            <x-primary-button class="p-2 sm:text-base bg-gray-700 rounded-lg w-full hover:bg-gray-800 text-white normal-case flex items-center justify-center">
                {{ __('Registrarse') }}
            </x-primary-button>

            <a class="underline text-sm text-gray-400 hover:text-gray-300" href="{{ route('login') }}" wire:navigate>
                {{ __('¿Ya registrado? Inicia sesión') }}
            </a>
        </div>
    </form>
</div>
