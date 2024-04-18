<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
    <title>Banka</title>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900 flex-col">
<h1 class="text-white mb-20 text-6xl font-medium">Register</h1>
<div class="w-full max-w-xs">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/user" method="post" enctype="application/json">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" placeholder="Username" value="{{old('username')}}">
            @error('username')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="******************">
            @error('password')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            <p class="flex items-center gap-1 font-sans text-sm antialiased font-normal leading-normal text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 -mt-px">
                    <path fill-rule="evenodd"
                          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                          clip-rule="evenodd"></path>
                </svg>
                Use at least 6 characters.
            </p>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                Confirm Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" id="password_confirmation" type="password" placeholder="******************">
            @error('password_confirmation')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Register
            </button>
            <a href="/login" class="text-blue-500 visited:text-blue-500 hover:text-blue-700 font-bold py-2 px-4" type="link">
                Login
            </a>
        </div>
    </form>
</div>
</body>
</html>
