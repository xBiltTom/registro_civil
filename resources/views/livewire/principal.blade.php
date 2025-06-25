<x-app-layout>


    <div class="pt-4 p-2 sm:pt-2  sm:ml-64 ">
        <div class=" border-gray-200 dark:border-gray-700 mt-16">
            @yield('content')
        </div>
    </div>
    @stack('js')

</x-app-layout>


