@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-10 px-4">
        <h1 class="text-4xl sm:text-5xl font-bold mb-6">Welcome Investec Developer</h1>
        <p class="text-lg sm:text-xl mb-4">Explore the best in coding with us and look around.</p>
    </div>

    @if ($accessToken)
        <section id="access-token" class="py-10 bg-gray-50 px-4">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-6 text-center">Access Token (Sandbox)</h2>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center break-words">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Your Access Token:</h3>
                    <p class="text-gray-600 text-sm sm:text-base">{{ $accessToken }}</p>
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('fetch.account.info') }}" class="bg-blue-600 text-white my-1 py-3 px-4 rounded-lg text-lg hover:bg-blue-500 transition inline-block mx-2">Fetch Account Info</a>
                   
                </div>
            </div>
        </section>
    @else
        <section id="access-token" class="py-10 bg-gray-50 px-4">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-6">No Access Token Available</h2>
                <p class="text-gray-600 text-sm sm:text-base">You can request a new access token by clicking the button below.</p>
                <div class="mt-6">
                    <a href="{{ route('authenticate') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg text-lg hover:bg-blue-500 transition inline-block">Request Access Token</a>
                </div>
            </div>
        </section>
    @endif

    <section id="features" class="py-10 bg-gray-50 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-6 text-center">Help</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Investec Developer Project Repo</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Explore the code repository for the Investec Developer Project on GitHub.</p>
                    <a href="https://github.com/alecshelembe/investec-developer-project-repo" class="text-blue-500 hover:underline block mt-3" target="_blank">View Repo</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Investec API Documentation</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Check out the release notes and API documentation for SA PB Account Information.</p>
                    <a href="https://developer.investec.com/za/api-products/documentation/SA_PB_Account_Information#section/Release-Notes" class="text-blue-500 hover:underline block mt-3" target="_blank">View Documentation</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Investec Developer Community</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Join the Investec Developer Community to stay updated and get support from fellow developers.</p>
                    <a href="https://github.com/Investec-Developer-Community" class="text-blue-500 hover:underline block mt-3" target="_blank">Join the Community</a>
                </div>
            </div>
        </div>
    </section>
@endsection