@extends('livewire.principal')
@section('content')
<div class="text-gray-900 pt-16 pb-24 px-6 w-full bg-gray-50">
    <div class="max-w-7xl mx-auto text-center">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <!-- User Count -->
        <div class="flex flex-col items-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
          <div
            class="mb-6 flex items-center justify-center w-28 h-28 rounded-full bg-gradient-to-r from-purple-500 to-pink-400 p-1">
            <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-gray-900"
                viewBox="0 0 24 24">
                <path
                  d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z">
                </path>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-extrabold text-gray-800">70,680 +</div>
          <div class="text-gray-500">Users</div>
        </div>
        <!-- Documents Count -->
        <div class="flex flex-col items-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
          <div
            class="mb-6 flex items-center justify-center w-28 h-28 rounded-full bg-gradient-to-r from-purple-500 to-pink-400 p-1">
            <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-gray-900"
                viewBox="0 0 24 24">
                <path
                  d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm0 2h7v5h5v11H6zm2 8v2h8v-2zm0 4v2h5v-2z">
                </path>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-extrabold text-gray-800">651,589 +</div>
          <div class="text-gray-500">Papers and Documents Processed</div>
        </div>
        <!-- Languages Supported -->
        <div class="flex flex-col items-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
          <div
            class="mb-6 flex items-center justify-center w-28 h-28 rounded-full bg-gradient-to-r from-purple-500 to-pink-400 p-1">
            <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-gray-900"
                viewBox="0 0 24 24">
                <path
                  d="M17.9 17.39c-.26-.8-1.01-1.39-1.9-1.39h-1v-3a1 1 0 0 0-1-1H8v-2h2a1 1 0 0 0 1-1V7h2a2 2 0 0 0 2-2v-.41a7.984 7.984 0 0 1 2.9 12.8M11 19.93c-3.95-.49-7-3.85-7-7.93c0-.62.08-1.22.21-1.79L9 15v1a2 2 0 0 0 2 2m1-16A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2">
                </path>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-extrabold text-gray-800">50 +</div>
          <div class="text-gray-500">Languages Supported</div>
        </div>
      </div>
    </div>
  </div>
@endsection
