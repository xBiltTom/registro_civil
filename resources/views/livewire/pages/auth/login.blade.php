<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth-login')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        $usuario = auth()->user()->persona;
        if($usuario->sexo=="F"){
            session()->flash('message',"Bienvenida $usuario->nombre $usuario->apellido");
        } else {
            session()->flash('message',"Bienvenido $usuario->nombre $usuario->apellido");
        }
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
};
?>

<div class="w-[90%] max-w-[380px] bg-gray-900 text-gray-200 rounded-xl p-8 shadow-xl z-10 text-center mx-auto">
    <img
        src="https://upload.wikimedia.org/wikipedia/commons/6/67/User_Avatar.png"
        alt="User Avatar"
        class="mx-auto w-24 h-24 mb-4 rounded-full"
    >

    <p class="text-xl sm:text-2xl font-semibold mb-2 text-gray-100">Login</p>
    <hr class="border-gray-700 mb-6">

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="mb-4 text-left">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-400" />
        </div>

        <div class="mb-4 text-left">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-300" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full bg-gray-800 text-gray-200 border-gray-700 focus:border-blue-500 focus:ring-blue-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-400" />
        </div>

        <div class="block mt-4 text-left">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-700 text-blue-500 shadow-sm focus:ring-blue-500">
                <span class="ms-2 text-sm text-gray-300">{{ __('Recordar sesión') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center mt-6 gap-4">
            <x-primary-button class="p-2 sm:text-base bg-blue-600 rounded-lg w-full hover:bg-blue-700 text-white normal-case flex items-center justify-center">
                {{ __('Iniciar sesión') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-blue-400" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>
    </form>

    <p class="mt-6 text-sm text-gray-300">¿Eres nuevo aquí? <a href="{{route('register')}}" class="underline hover:text-blue-400">Regístrate</a></p>
</div>
