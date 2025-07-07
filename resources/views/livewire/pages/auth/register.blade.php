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

<div class="w-[90%] max-w-[380px] bg-white/10 backdrop-blur-md text-white rounded-xl p-8 shadow-2xl ring-1 ring-white/20 z-10 text-center mx-auto">
    <p class="text-xl sm:text-2xl font-semibold mb-2 text-white">Crear cuenta</p>
    <hr class="border-white/30 mb-6">

    <form wire:submit="register">
        <div class="mb-4 text-left">
            <x-input-label for="dni" :value="__('DNI')" class="text-white" />
            <x-text-input
                wire:model="dni"
                id="dni"
                class="block mt-1 w-full bg-white/10 backdrop-blur-sm text-white border-white/30 focus:border-white/70 focus:ring-white placeholder-white/60"
                type="text"
                name="dni"
                required
                autofocus
                autocomplete="dni"
            />
            <x-input-error :messages="$errors->get('dni')" class="mt-2 text-red-400" />
        </div>

        <div class="mb-4 text-left">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input
                wire:model="email"
                id="email"
                class="block mt-1 w-full bg-white/10 backdrop-blur-sm text-white border-white/30 focus:border-white/70 focus:ring-white placeholder-white/60"
                type="email"
                name="email"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mb-4 text-left">
            <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
            <x-text-input
                wire:model="password"
                id="password"
                class="block mt-1 w-full bg-white/10 backdrop-blur-sm text-white border-white/30 focus:border-white/70 focus:ring-white placeholder-white/60"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="mb-4 text-left">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-white" />
            <x-text-input
                wire:model="password_confirmation"
                id="password_confirmation"
                class="block mt-1 w-full bg-white/10 backdrop-blur-sm text-white border-white/30 focus:border-white/70 focus:ring-white placeholder-white/60"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex flex-col items-center justify-center mt-6 gap-4">
            <x-primary-button class="p-2 sm:text-base bg-white/20 backdrop-blur text-white rounded-lg w-full hover:bg-white/30 normal-case flex items-center justify-center">
                {{ __('Registrarse') }}
            </x-primary-button>

            <a class="underline text-sm text-white/70 hover:text-white/90" href="{{ route('login') }}" wire:navigate>
                {{ __('¿Ya registrado? Inicia sesión') }}
            </a>
        </div>
    </form>
</div>
