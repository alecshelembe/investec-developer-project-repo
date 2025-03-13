@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .btn {
            display: inline-block;
            background: linear-gradient(90deg, #2563eb, #1e40af);
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: linear-gradient(90deg, #1e40af, #1e3a8a);
            transform: scale(1.03);
        }
    </style>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white text-center py-16 px-6 fade-in">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Welcome Investec Developer</h1>
        <p class="text-lg sm:text-xl opacity-90">Explore the best in coding with us and look around.</p>
    </div>

    @if ($accessToken)
        <!-- Access Token Section -->
        <section id="access-token" class="py-12 bg-gray-50 fade-in">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Access Token (Sandbox)</h2>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center break-words hover-card transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Your Access Token:</h3>
                    <p class="text-gray-600 text-sm sm:text-base">{{ $accessToken }}</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('fetch.account.info') }}" class="btn mx-2">Fetch Account Info</a>
                </div>
            </div>
        </section>
    @else
        <!-- No Token Available -->
        <section id="access-token" class="py-12 bg-gray-50 fade-in">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">No Access Token Available</h2>
                <p class="text-gray-600">Request a new access token by clicking below.</p>
                <div class="mt-6">
                    <a href="{{ route('authenticate') }}" class="btn">Request Access Token</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Help Section -->
    <section id="features" class="py-12 bg-gray-50 fade-in">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Help</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-lg rounded-lg p-6 text-center hover-card transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Investec Developer Project Repo</h3>
                    <p class="text-gray-600 text-sm">Explore the GitHub repository for the Investec Developer Project.</p>
                    <a href="https://github.com/alecshelembe/investec-developer-project-repo" class="text-blue-500 hover:underline block mt-3" target="_blank">View Repo</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center hover-card transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Investec API Documentation</h3>
                    <p class="text-gray-600 text-sm">Check the API documentation for SA PB Account Information.</p>
                    <a href="https://developer.investec.com/za/api-products/documentation/SA_PB_Account_Information#section/Release-Notes" class="text-blue-500 hover:underline block mt-3" target="_blank">View Documentation</a>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center hover-card transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Investec Developer Community</h3>
                    <p class="text-gray-600 text-sm">Join the Investec Developer Community for support and updates.</p>
                    <a href="https://github.com/Investec-Developer-Community" class="text-blue-500 hover:underline block mt-3" target="_blank">Join the Community</a>
                </div>
            </div>
        </div>
    </section>
@endsection
