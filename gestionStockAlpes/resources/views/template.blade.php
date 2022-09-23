<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('default')
        
      <title>Alpes - @yield('title')</title>
  
    </head>
    <body>
        <header class="bg-indigo-600">
            <nav class="ml-0 mr-auto max-w-full px-4 sm:px-6 lg:px-8" aria-label="Top">
              <div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
                  <div class="flex min-w-full">
                    <span class="sr-only">Alpes</span>
                    <img class="absolute h-10 w-auto" src="https://www.datacenterplatform.com/wp-content/uploads/2022/05/Alpes-Networks-SAS-1.png" alt="">
                  <h2 class="min-w-full text-base font-medium text-center sm:text-2xl text-white hover:text-indigo-50">Gestion du Stock</h2>
                </div>
            </nav>
          </header>
  
          <br>
          <br>
        @yield('content')
    </body>
</html>