<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('default')
        
      <title>Alpes - @yield('title')</title>
  
    </head>
    <body>
        <header class="bg-indigo-600">
            <nav class="ml-0 mr-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Top">
              <div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
                <div class="flex items-center">
                  <a href="#">
                    <span class="sr-only">Alpes</span>
                    <img class="h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=white" alt="">
                  </a>
                  <div class="ml-10 hidden space-x-8 lg:block">
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Stock</a>
          
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Ajouter un produit</a>
          
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Retirer un produit</a>
          
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap justify-center space-x-6 py-4 lg:hidden">
                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Stock</a>
          
                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Ajouter un produit</a>
          
                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Retirer un produit</a>
          
              </div>
            </nav>
          </header>
  
          <br>
          <br>
        @yield('content')
    </body>
</html>