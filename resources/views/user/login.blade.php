<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
    <title>Banka</title>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900 flex-col">
<h1 class="text-white mb-20 text-6xl font-medium">Login</h1>
<div class="w-full max-w-xs">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/user/authenticate" method="post">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" placeholder="Username" value="{{old('username')}}">
            @error('username')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="******************">
            @error('password')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Login
            </button>
            <a href="/register" class="text-blue-500 visited:text-blue-500 hover:text-blue-700 font-bold py-2 px-4" type="link">
                Register
            </a>
        </div>
    </form>
</div>
</body>
</html>
