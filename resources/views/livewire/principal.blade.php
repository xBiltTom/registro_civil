<x-app-layout>
    {{-- <x-slot name="sidebar">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sidebar') }}
        </h2>

    </x-slot> --}}

    <div class="pt-4 p-2 sm:pt-2  sm:ml-64 ">
        <div class=" border-gray-200 dark:border-gray-700 mt-14">
            @yield('content')

        </div>
     </div>
</x-app-layout>
