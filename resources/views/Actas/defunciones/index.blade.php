@extends('livewire.principal')
@section('content')

@if (session('message'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 transition-opacity duration-500 ease-out"
        role="alert"
    >
        <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20">
            <path d="..." />
        </svg>
        <div>
            <span class="font-medium">Datos actualizados!</span> {{ session('message') }}
        </div>
    </div>
@endif

   <livewire:actas.acta-defuncion.index lazy/>

@endsection

