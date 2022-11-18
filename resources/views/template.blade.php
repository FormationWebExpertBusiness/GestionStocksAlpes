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
                @livewire('menu')
            </div>
        </div>
    </div>
    @yield('content')
</body>

</html>
