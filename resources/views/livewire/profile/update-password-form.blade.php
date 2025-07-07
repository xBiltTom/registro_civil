<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="bg-gray-800  rounded-2xl shadow-md p-6">
    <header>
        <h2 class="text-lg font-semibold text-white">
            {{ __('Actualizar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __('Asegúrate de usar una contraseña larga y segura para proteger tu cuenta.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        {{-- Contraseña actual --}}
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña actual')" class="text-gray-200"/>
            <x-text-input
                wire:model="current_password"
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
            />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        {{-- Nueva contraseña --}}
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva contraseña')" class="text-gray-200"/>
            <x-text-input
                wire:model="password"
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmación de contraseña --}}
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-200"/>
            <x-text-input
                wire:model="password_confirmation"
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Botón guardar --}}
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                {{ __('Guardar') }}
            </x-primary-button>

            <x-action-message class="text-green-400" on="password-updated">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
</section>
