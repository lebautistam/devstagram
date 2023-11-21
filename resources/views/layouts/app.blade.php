<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        @stack('styles')
        <title>Devstagram - @yield('titulo')</title>
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles()
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    <a href="{{ route('home') }}">DevStagram</a>
                </h1>

                @auth
                    <nav class="flex gap-2 items-center">
                        <a href="{{ route('post.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                            </svg>
                              
                            Crear
                        </a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('post.index', auth()->user()->username) }}">Hola: {{ auth()->user()->username }}</a>
                        <form action="{{ route('logout') }}" method="POST"> 
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesión</button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
                @endguest
               
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>


        <footer class=" mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            DevStagram - todos los derechos reservados {{ now()->year }}
        </footer>
        @livewireScripts()
    </body>
</html>