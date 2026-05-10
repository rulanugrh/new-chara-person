<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-100 text-slate-900">
        <div class="min-h-screen flex">
            <x-admin-sidebar />

            <div class="flex-1">
                <header class="bg-white border-b border-slate-200 px-6 py-4 sticky top-0 z-10">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h1 class="text-xl font-semibold text-slate-900">@yield('title')</h1>
                            @hasSection('subtitle')
                                <p class="text-sm text-slate-500">@yield('subtitle')</p>
                            @endif
                        </div>
                        <div class="text-sm text-slate-600">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                </header>

                <main class="p-6">
                    <x-alerts />
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
