<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @vite('resources/css/app.css')
        <title>Banka</title>
    </head>
    <body class="h-screen flex items-center justify-center bg-gray-900 flex-col">
        <h1 class="text-white mb-20 text-6xl font-medium">Welcome to the bank </h1>
        <div class="flex items-center space-x-20">
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="/register">Register</a>
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="/login">Login</a>
        </div>
    </body>
</html>
