<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $email = '';
    public $photo;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'photo' => ['nullable','image','max:2048'],
        ]);

        if ($this->photo) {
            $ruta = $this->photo->store('usuarios', 'public');
            $user->ruta_foto = $ruta;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->photo = null;
        $this->dispatch('profile-updated', name: $user->name);
        $this->redirect(request()->header('Referer') ?? '/');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="bg-gray-800 rounded-2xl shadow-md p-6">
    <header>
        <h2 class="text-lg font-semibold text-white">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __("Actualiza la información de tu perfil y correo electrónico.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        {{-- Nombre --}}
        <div>
            <x-input-label for="name" :value="__('Nombre de usuario')" class="text-gray-200" />
            <x-text-input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                required
                autofocus
                autocomplete="name"
                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Correo --}}
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-200" />
            <x-text-input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                required
                autocomplete="username"
                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- Verificación de correo --}}
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-300">
                        {{ __('Tu correo electrónico no está verificado.') }}

                        <button wire:click.prevent="sendVerification"
                                class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Foto actual --}}
        <div class="mt-4">
            <x-input-label value="Foto actual" class="text-gray-200" />
            @if (Auth::user()->ruta_foto)
                <img src="{{ asset('storage/' . Auth::user()->ruta_foto) }}" alt="Foto actual" class="w-20 h-20 rounded-full mt-2">
            @else
                <p class="text-sm text-gray-300 mt-2">No hay foto subida</p>
            @endif
        </div>

        {{-- Subir nueva foto --}}
        <div class="mt-4">
            <x-input-label for="photo" value="Nueva foto de perfil" class="text-gray-200" />
            <input
                type="file"
                id="photo"
                wire:model="photo"
                class="mt-1 block w-full text-white bg-gray-700 border border-gray-600 rounded-md"
                accept="image/*"
            >
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        {{-- Botón guardar --}}
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                {{ __('Guardar') }}
            </x-primary-button>

            <x-action-message class="text-green-400" on="profile-updated">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
</section>
