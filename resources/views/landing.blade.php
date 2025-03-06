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
            <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Our Key Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Feature 1</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat vestibulum urna eu auctor.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Feature 2</h3>
                    <p class="text-gray-600">Integer auctor magna sit amet mi posuere, in malesuada libero vehicula. Cras id risus nulla.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Feature 3</h3>
                    <p class="text-gray-600">Nullam non urna vitae felis suscipit tempus. Proin interdum, sem ut hendrerit auctor, nisi metus iaculis lectus.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
