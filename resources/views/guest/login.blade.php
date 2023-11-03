<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">
    @include('sweetalert::alert')
    <div class="p-5 h-full">
        <div class="grid grid-cols-12 gap-10 h-full">
            <div class="flex flex-col justify-center gap-20 px-28 col-span-7">
                <div class="title">
                    <h1 class="text-3xl mb-2 font-bold">Sign In</h1>
                    <h5 class="text-xl">Welcome to Product App</h5>
                </div>
                <div>
                    <form action="{{ route('guest.authLogin') }}" method="POST">
                        @csrf
                        <div class="mb-7 flex flex-col gap-4">
                            <label class="text-lg" for="email">Email</label>
                            <input class="border border-light-color py-3 px-4 rounded-lg focus:outline-primary" type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-7 flex flex-col gap-4">
                            <label class="text-lg" for="password">Password</label>
                            <input class="border border-light-color py-3 px-4 rounded-lg focus:outline-primary" type="password" id="password" name="password" required>
                        </div>
                        <div class="mb-7 flex gap-4 items-center">
                            <input class="w-4 h-4" type="checkbox" id="remember" name="remember">
                            <label class="text-lg" for="remember">Remember me</label>
                        </div>
                        <div class="mb-7">
                            <button type="submit" class="bg-primary w-full py-3 rounded-lg text-white border border-primary hover:bg-transparent hover:text-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full h-full flex flex-col justify-center bg-primary rounded-3xl px-20 col-span-5">
                <h1 class="text-5xl text-white mb-4">Product App.</h1>
                <h6 class="text-2xl text-white font-light">Manage Product Easier</h6>
            </div>
        </div>
    </div>
</body>
</html>
