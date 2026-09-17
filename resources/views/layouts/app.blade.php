<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">

@if(Auth::check() && is_null(Auth::user()->company_id))
@include('partials.setup-company')
@endif
    @if(session('success'))
    <x-flash type="success"
        :title="session('success-title', 'Success')"
        :message="session('success')" />
    @endif

    @if(session('error'))
    <x-flash type="error"
        :title="session('error-title', 'Error')"
        :message="session('error')" />
    @endif
    
    @if ($errors->any())
    <x-flash type="error"
        title="Validation Error"
        :message="$errors->all()" />
    @endif



    <!--<div class="flex flex-col md:flex-row h-screen bg-gradient-to-br from-slate-50 via-blue-50/80 to-indigo-50/20 relative overflow-hidden">-->
    <div class="flex flex-col md:flex-row h-screen bg-blue-50 relative overflow-hidden">
    <!-- Subtle Mesh Grid Pattern -->
    <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:24px_24px] opacity-40 pointer-events-none"></div>
    
    <!-- Soft Organic Glows -->
    <div class="absolute top-0 right-1/4 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-purple-300/10 rounded-full blur-3xl pointer-events-none"></div>

    @include('layouts.navigation')

    <div class="z-10 flex-1 p-4 md:p-6 overflow-auto">
        @isset($header)
        <header class="mt-2 mb-4 p-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</div>
    @livewireScripts
    @livewire('livewire-ui-modal')

</body>

</html>