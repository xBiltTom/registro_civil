@extends('livewire.principal')

@section('content')
{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot> --}}

<div class="">
    <div class=" mx-auto  space-y-6">

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="">
                <livewire:personal.selfinfo/>
            </div>
        </div>



        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form/>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.update-password-form/>
            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div> --}}
    </div>
</div>

@endsection
