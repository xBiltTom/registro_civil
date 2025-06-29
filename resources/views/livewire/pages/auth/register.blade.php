<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Persona;

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
            // Si no existe la persona, lanzar un error de validación
            $this->addError('dni', 'No se encontró una persona con este DNI.');
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
            // Si ya tiene un usuario, lanzar un error de validación
            $this->addError('dni', 'Esta persona ya tiene un usuario registrado.');
            return;
        }

        // Asociar la persona al usuario y registrar
        $validated['persona_id'] = $persona->id;
        $validated['name'] = 'usuario ' . $persona->nombre; // ← aquí
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div class="text-gray-800">
            <x-input-label for="name" :value="__('DNI')" />
            <x-text-input wire:model="dni" id="dni" class="block mt-1 w-full" type="text" name="dni" required autofocus autocomplete="dni" />
            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 text-gray-800">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 text-gray-800">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 text-gray-800">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-900 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Ya registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</div>
