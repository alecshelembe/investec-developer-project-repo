@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-12">
    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Account Balance</h2>
        
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2 flex justify-between items-center bg-white bg-opacity-20 rounded-xl p-4">
                <p class="text-lg font-medium">Account ID</p>
                <p class="text-lg font-semibold">{{ $balance['accountId'] }}</p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-xl">
                <p class="text-sm">Current Balance</p>
                <p class="text-xl font-semibold">R {{ number_format($balance['currentBalance'], 2) }}</p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-xl">
                <p class="text-sm">Available Balance</p>
                <p class="text-xl font-semibold text-green-300">R {{ number_format($balance['availableBalance'], 2) }}</p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-xl">
                <p class="text-sm">Budget Balance</p>
                <p class="text-xl font-semibold">R {{ number_format($balance['budgetBalance'], 2) }}</p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-xl">
                <p class="text-sm">Straight Balance</p>
                <p class="text-xl font-semibold">R {{ number_format($balance['straightBalance'], 2) }}</p>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-xl">
                <p class="text-sm">Cash Balance</p>
                <p class="text-xl font-semibold text-red-300">R {{ number_format($balance['cashBalance'], 2) }}</p>
            </div>
            <div class="col-span-2 flex justify-between items-center bg-white bg-opacity-20 rounded-xl p-4">
                <p class="text-lg font-medium">Currency</p>
                <p class="text-lg font-semibold">{{ $balance['currency'] }}</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="px-5 py-3 bg-white text-indigo-600 font-bold rounded-lg shadow-md hover:bg-gray-100">Go Back</a>
        </div>
    </div>
</div>
@endsection