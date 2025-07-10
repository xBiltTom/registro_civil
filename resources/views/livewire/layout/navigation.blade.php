<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Persona;
use App\Models\Solicitud;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */

    /**
     * Número de solicitudes pendientes
     */
     public $solicitudesPendientes = 0;

    /**
     * Inicializar el componente
     */
    public function mount(): void
    {
        $this->cargarSolicitudesPendientes();
    }

    /**
     * Cargar el contador de solicitudes pendientes
     */
    public function cargarSolicitudesPendientes(): void
    {
        // Contar solicitudes con estado pendiente (estado_id = 1)
        $this->solicitudesPendientes = Solicitud::where('estado_id', 1)->count();
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    /**
     * Usar polling para actualizar el contador cada 10 segundos
     */
    public function polling(): void
    {
        $this->cargarSolicitudesPendientes();
    }
}; ?>

<div>


<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-0 lg:px-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
              </svg>
           </button>
           <a href="https://flowbite.com" class="flex ms-2 md:me-24 items-center">
            <img src="/img/LOGUITO.png" class="h-16 me-6" alt="FlowBite Logo" />
           </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <!-- Enlace de "Solicitudes" -->
                <div class="flex items-center">
                    @can('ver actas')
                        <li class="list-none">
                            <a href="{{route('solicitudes')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                </svg>
                                <span class="ms-3">Solicitudes</span>
                                <livewire:solicitudes.contador />
                            </a>
                        </li>
                    @endcan
                    @can('ver usuarios')
                        <li class="list-none">
                            <a href="{{route('validar-usuarios')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                </svg>
                                <span class="ms-3">Validar usuarios</span>
                                {{-- <livewire:solicitudes.contador /> --}}
                            </a>
                        </li>
                    @endcan
                    @can('ver actas')
                        <li class="list-none">
                            <a href="{{route('reportes')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                 <path d="M12 16v5"/>
                                 <path d="M16 14v7"/>
                                 <path d="M20 10v11"/>
                                 <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/>
                                 <path d="M4 18v3"/>
                                 <path d="M8 14v7"/>
                           </svg>
                                <span class="ms-3">Reportes</span>
                            </a>
                        </li>
                    @endcan
                        <p class="text-white mx-2">|</p>
                        <li class="list-none">
                            <p {{-- href="{{route('solicitudes')}}" wire:navigate --}} class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                {{-- <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                                </svg> --}}
                                <span class="">
                                    {{ auth()->user()->persona->nombre ?? 'Usuario' }} , {{ auth()->user()->persona->apellido ?? 'Usuario' }}
                                </span>
                            </p>

                        </li>
                </div>
            </div>
            <div class="flex items-center ms-3">
                <div class="relative">
                    <!-- Punto verde si el usuario está activo -->
                    @if(auth()->user()->estado == 1)
                        <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    @endif

                    <!-- Imagen del usuario -->
                    {{-- <button type="button" class=" flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <p class="text-sm text-gray-900 dark:text-white mx-10" role="none">
                            {{auth()->user()->persona->nombre ?? 'Usuario'}} , {{auth()->user()->persona->apellido ?? 'Usuario'}}
                        </p>

                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button> --}}
                    <!-- Botón con SVG dinámico -->
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <!-- SVG con iniciales dinámicas -->
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->persona->nombre ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->persona->apellido ?? 'U', 0, 1)) }}
                        </div>
                    </button>
                </div>
              <div class="border border-gray-800 border-3 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    @if(auth()->user()->estado==1)
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{auth()->user()->getRoleNames()->first() ?? 'Usuario'}}
                  </p>
                  @endif
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ auth()->user()->email ?? 'Correo no disponible' }}
                  </p>
                </div>
                <ul class="py-1" role="none">
                    @if(auth()->user()->estado==1)
                  <li>
                    <a href="{{route('dashboard')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Principal</a>
                  </li>

                  <li>
                    <a href="{{route('profile')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Perfil</a>
                  </li>
                  {{-- <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                  </li> --}}
                  @endif
                  <li>
                    <a wire:click="logout" class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Salir</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>

  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
           <li>

              <a href="{{route('dashboard')}}" {{-- :active="request()->routeIs('dashboard')" --}} wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                     <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                     <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                  </svg>

                 <span class="ms-3">Principal</span>
              </a>
           </li>
           <li>
            <a href="{{route('personal')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M15 13a3 3 0 1 0-6 0"/>
                  <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                  <circle cx="12" cy="8" r="2"/>
               </svg>

               <span class="ms-3">Personal</span>
            </a>
         </li>
      {{--    @cannot('ver actas') --}}
         <li>
            <a href="{{route('solicitudes.personal')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                  <rect x="2" y="4" width="20" height="16" rx="2"/>
               </svg>

               <span class="ms-3">Mis solicitudes</span>
            </a>
         </li>
         @if(auth()->user()->estado==0)
         <li>
            <a href="{{route('solicitudes.personal')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                  <rect x="2" y="4" width="20" height="16" rx="2"/>
               </svg>

               <span class="ms-3">Verificar usuario</span>
            </a>
         </li>
         @endif
         {{-- @endcannot --}}

           @can('ver actas')
           <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                     <path d="M15 12h-5"/><path d="M15 8h-5"/>
                     <path d="M19 17V5a2 2 0 0 0-2-2H4"/>
                     <path d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3"/>
                  </svg>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Acta</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                    <a href="{{route('actas-nacimiento')}}" wire:navigate class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Actas de Nacimiento</a>
                  </li>
                  <li>
                     <a href="{{route('actas-matrimonio')}}" wire:navigate class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Actas de Matrimonio</a>
                  </li>
                  <li>
                     <a href="{{route('mad')}}" wire:navigate class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Actas de Defunción</a>
                  </li>
            </ul>
         </li>

           @endcan
           {{--  --}}
           @can('ver personas')
           <li>
            <a href="{{route('personas.index')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                  <path d="M16 3.128a4 4 0 0 1 0 7.744"/>
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                  <circle cx="9" cy="7" r="4"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Personas</span>
            </a>
         </li>
         @endcan
         @can('ver permisos')
            <li>
                <a href="{{route('admin')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
                     </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Administracion</span>
                    <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">adm</span>
                </a>

           </li>
           @endcan
           <li>
            @can('ver usuarios')
            <a href="{{route('usuarios.index')}}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M10 15H6a4 4 0 0 0-4 4v2"/>
                  <path d="m14.305 16.53.923-.382"/>
                  <path d="m15.228 13.852-.923-.383"/>
                  <path d="m16.852 12.228-.383-.923"/>
                  <path d="m16.852 17.772-.383.924"/>
                  <path d="m19.148 12.228.383-.923"/>
                  <path d="m19.53 18.696-.382-.924"/>
                  <path d="m20.772 13.852.924-.383"/>
                  <path d="m20.772 16.148.924.383"/>
                  <circle cx="18" cy="15" r="3"/>
                  <circle cx="9" cy="7" r="4"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
               <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">adm</span>
            </a>
            @endcan
         </li>
         @can('ver usuarios')
         <li>
             <a href="{{ route('solicitudes.general') }}" wire:navigate class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                     <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                     <rect x="2" y="4" width="20" height="16" rx="2"/>
                 </svg>
                 <span class="ms-3">Solicitudes</span>
             </a>
         </li>
         @endcan
          {{--  <li>
              <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                 </svg>
                 <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
              </a>
           </li> --}}
           {{-- <li>
              <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                    <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                    <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                 </svg>
                 <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
              </a>
           </li> --}}
        </ul>
     </div>
  </aside>


</div>
