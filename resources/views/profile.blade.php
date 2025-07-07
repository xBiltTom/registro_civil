@extends('livewire.principal')

@section('content')
<div class="min-h-screen bg-gray-900 text-white py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-8">

        {{-- Información personal mostrada --}}
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-2xl p-6">
            <livewire:personal.selfinfo />
        </div>

        {{-- Actualizar información del perfil --}}
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-2xl p-6">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-2xl p-6">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        {{-- Eliminar cuenta (desactivado por ahora) --}}
        {{-- 
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-2xl p-6">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div> 
        --}}

    </div>
</div>
@endsection
