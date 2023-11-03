<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="h-full">
    @include('sweetalert::alert')
    <div class="w-full h-full flex flex-row gap-5 bg-bg-color p-5">
        <input type="checkbox" class="hidden peer/sidebar" id="btnSidebar">
        <div class="w-80 bg-white rounded-2xl flex flex-col peer-checked/sidebar:-ms-60 transition-all">
            <div class="title flex items-center justify-between p-8">
                <h1 class="text-xl font-bold">Product App.</h1>
                <label for="btnSidebar" class="cursor-pointer">
                    <i class="bi bi-list text-2xl font-bold"></i>
                </label>
            </div>
            <div class="side-nav flex flex-col justify-between h-full">
                <div class="flex flex-col gap-5 p-3">
                    <a class="px-5 py-4 rounded-lg flex flex-row gap-4 @if($title == 'Dashboard') bg-bg-color @endif" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                    <a class="px-5 py-4 rounded-lg flex flex-row gap-4 @if($title == 'Products') bg-bg-color @endif" href="{{ route('admin.products') }}" wire:navigate>
                        <i class="bi bi-grid"></i> Products
                    </a>
                </div>
                <div class="p-3">
                    <a class="px-5 py-4 rounded-lg flex flex-row gap-4 @if($title == 'Products') bg-bg-color @endif" href="{{ route('admin.logout') }}" wire:navigate>
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col gap-5">
            <div class="bg-white rounded-2xl px-8 py-8 flex items-center gap-4">
                <div class="greeting">
                    <h1 class="font-xl">Welcome, <span class="font-bold">{{ Auth::user()->name }}</span></h1>
                </div>
            </div>
            <div class="bg-white rounded-2xl flex flex-col gap-5 p-8 overflow-y-auto">
                <div class="title">
                    <h1 class="text-xl font-bold">{{ $title }}</h1>
                </div>
                <div class="content">
                    @yield('admin-layout')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    @stack('js')
    @livewireScripts
</body>
</html>
