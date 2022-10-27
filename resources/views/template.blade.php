<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('default')
    <title>Alpes - @yield('title')</title>
  </head>
  <body>
    <div class="md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
      <div class="flex min-h-0 flex-1 flex-col bg-indigo-700">
        <div class="flex flex-1 flex-col pt-5 pb-4">
          <div class="flex justify-center flex-shrink-0 px-4">
            <img class="h-10 w-auto" src="https://www.datacenterplatform.com/wp-content/uploads/2022/05/Alpes-Networks-SAS-1.png" alt="Alpes Networks">
          </div>
          <nav class="mt-5 flex-1 space-y-1 px-2">
            <a href="/" class="bg-indigo-800 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
              </svg>
              Dashboard
            </a>
            <a href="/stock" class="bg-indigo-800 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300">
                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z" />
              </svg>
              
              Stock
            </a>

            @if (Auth::check())
            <a href="/logout" class="bg-indigo-800 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
              </svg>
              Déconnexion
            </a>
            @endif
          </nav>
        </div>
      </div>
    </div>
    @yield('content')
  </body>
</html>