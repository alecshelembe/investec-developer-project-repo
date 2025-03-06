@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-20">
        <h1 class="text-5xl font-bold mb-6">Welcome Investec Developer</h1>
        <p class="text-xl mb-8">Explore the best in coding with us and look around.</p>
        <!-- <a href="#features" class="bg-yellow-500 text-black py-3 px-6 rounded-lg text-lg hover:bg-yellow-400 transition">Explore Features</a> -->
    </div>

    <!-- Display Access Token if Exists -->
    @if ($accessToken)
        <section id="access-token" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Access Token (Sandbox)</h2>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Your Access Token:</h3>
                    <p class="text-gray-600">{{ $accessToken }}</p>
                </div>
            </div>
        </section>
    @else
        <section id="access-token" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">No Access Token Available</h2>
                <p class="text-gray-600">You can request a new access token by clicking the button below.</p>
                <div class="text-center mt-6">
                    <a href="{{ route('authenticate') }}" class="bg-blue-600 text-white py-3 px-8 rounded-lg text-lg hover:bg-blue-500 transition">Request Access Token</a>
                </div>
            </div>
        </section>
    @endif

    <section id="features" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Help</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Investec Developer Project Repo</h3>
                    <p class="text-gray-600">Explore the code repository for the Investec Developer Project on GitHub.</p>
                    <a href="https://github.com/alecshelembe/investec-developer-project-repo" class="text-blue-500 hover:underline" target="_blank">View Repo</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Investec API Documentation</h3>
                    <p class="text-gray-600">Check out the release notes and API documentation for SA PB Account Information.</p>
                    <a href="https://developer.investec.com/za/api-products/documentation/SA_PB_Account_Information#section/Release-Notes" class="text-blue-500 hover:underline" target="_blank">View Documentation</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Investec Developer Community</h3>
                    <p class="text-gray-600">Join the Investec Developer Community to stay updated and get support from fellow developers.</p>
                    <a href="https://github.com/Investec-Developer-Community" class="text-blue-500 hover:underline" target="_blank">Join the Community</a>
                </div>
            </div>
        </div>
    </section>

@endsection
