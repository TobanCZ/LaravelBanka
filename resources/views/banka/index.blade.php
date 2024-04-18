<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
    <title>Banka</title>
</head>
<body class="bg-gray-900 text-white">

<nav class="flex justify-between my-5 mx-7 font-bold text-lg">
    <h3 class="mx-2" >User: {{ auth()->user()->username }}</h3>
    <form class="mx-2 hover:text-gray-400" method="post" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<div class="flex justify-center items-center flex-col">
    <h1 class="text-center font-bold text-6xl mt-24 leading-loose">{{$money}} Kč</h1>
    <form id="form" class="mt-8" method="post" action="/banka/money">
        @csrf
        <input name="moneyInput" placeholder="Amount" class="peer w-[500px] border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-3xl text-center font-bold text-blue-gray-700 outline outline-0"/>
        @error('moneyInput')
        <p class="text-red-500 text-xs italic mt-1">{{$message}}</p>
        @enderror
        <div class="mt-10 flex justify-evenly">
            <button name="action" value="deposit" type="submit" class="w-[120px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >Deposit</button>
            <button name="action" value="withdraw" type="submit" class="w-[120px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Withdraw</button>
        </div>
    </form>

    <div class="flex flex-row justify-between w-full h-full px-20 flex-wrap">
        <div class="w-[500px] h-[250px] m-auto my-5 flex justify-center items-center flex-col">
            <h1 class="text-center font-bold text-5xl leading-loose">Kontokorent</h1>
                <label class="flex items-center justify-center cursor-pointer ">
                    <h3 class="mr-5 text-xl font-medium">Active kontokorent:</h3>
                    <form method="post" action="banka/kontokorentChecked">
                        @csrf
                        <input type="checkbox" value="" name="kontokorentCheckBox" onchange="this.form.submit()" class="sr-only peer" @if($kontokorentIsEnabled) checked @endif>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </form>
                </label>
            @if($kontokorentIsEnabled)
                <div class="flex justify-center align-middle items-baseline mt-5 flex-wrap">
                    <h3 class="mr-2 text-xl font-medium">Kontokorent size:</h3>
                    <form action="banka/kontokorentSet" method="post">
                        @csrf
                        <input name="kontokorentInput" value="{{$kontokorentSize}}" placeholder="Kontokorent" class="peer w-[200px] mr-2 border-b border-blue-gray-200 bg-transparent pt-1.5 pb-1.5 font-sans text-xl text-blue-gray-700 outline outline-0"/>
                        <button type="submit" class="w-[75px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >Save</button>
                        @error('kontokorentInput')
                        <p class="text-red-500 text-xs italic mt-1">{{$message}}</p>
                        @enderror
                    </form>
                </div>
                <h3 class="text-xl font-medium mt-7">Kontokorentu amount: {{$kontokorentAmount}}</h3>
            @endif
        </div>
        <div class="w-[500px] h-[250px] m-auto my-5 flex items-center flex-col">
            <h1 class="text-center font-bold text-5xl leading-loose">Loan</h1>
            <div class="flex justify-center align-middle items-baseline mt-5 flex-wrap">
                <h3 class="mr-2 text-xl font-medium">Loan size:</h3>
                <form action="/banka/lend" method="post">
                    @csrf
                    <input name="lendInput" placeholder="Loan" class="peer w-[200px] mr-2 border-b border-blue-gray-200 bg-transparent pt-1.5 pb-1.5 font-sans text-xl text-blue-gray-700 outline outline-0"/>
                    <button type="submit" class="w-[75px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >Lend</button>
                    @error('lendInput')
                    <p class="text-red-500 text-xs italic mt-1">{{$message}}</p>
                    @enderror
                </form>
            </div>
            <h3 class="text-xl font-medium mt-7">Amount of debt: {{$loan}}</h3>
            <form class="mt-5" action="banka/splatit" method="post">
                @csrf
                <input name="splatitInput" placeholder="Splatit" class="peer w-[200px] mr-2 border-b border-blue-gray-200 bg-transparent pt-1.5 pb-1.5 font-sans text-xl text-blue-gray-700 outline outline-0"/>
                <button type="submit" class="w-[75px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >Splatit</button>
                @error('splatitInput')
                <p class="text-red-500 text-xs italic mt-1">{{$message}}</p>
                @enderror
            </form>
        </div>
    </div>
</div>

</body>
</html>
