@extends('layouts.app')

@section('title', 'Account Information')

@section('content')
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Account Information</h2>

            <!-- Check if account data exists -->
            @if(isset($accountData) && !empty($accountData['data']['accounts']))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($accountData['data']['accounts'] as $account)
                        <!-- Account Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $account['referenceName'] }}</h3>
                            <h3 class="text-gray-600 mb-4">{{ $account['accountId'] }}</h3>
                            
                            <div class="space-y-4">
                                <!-- Account Number -->
                                <div>
                                    <strong class="text-gray-700">Account Number:</strong>
                                    <p class="text-gray-600">{{ $account['accountNumber'] }}</p>
                                </div>

                                <!-- Account Name -->
                                <div>
                                    <strong class="text-gray-700">Account Holder:</strong>
                                    <p class="text-gray-600">{{ $account['accountName'] }}</p>
                                </div>

                                <!-- Product Name -->
                                <div>
                                    <strong class="text-gray-700">Product Name:</strong>
                                    <p class="text-gray-600">{{ $account['productName'] }}</p>
                                </div>

                                <!-- KYC Compliance -->
                                <div>
                                    <strong class="text-gray-700">KYC Compliant:</strong>
                                    <p class="text-gray-600">{{ $account['kycCompliant'] ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>

                            <!-- Fetch Balance Button for Each Account -->
                            <button onclick="fetchBalance('{{ $account['accountId'] }}')" class="bg-blue-600 text-white my-2 py-2 px-4 rounded-lg text-lg hover:bg-blue-500 transition inline-block w-full">
                                Fetch Balance
                            </button>
                        </div>
                    @endforeach
                </div>
            @elseif(isset($error))
                <!-- Display error message if there's an error -->
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-8">
                    <p class="font-semibold">Error:</p>
                    <p>{{ $error }}</p>
                </div>
            @else
                <!-- Display message when no data is found -->
                <div class="bg-gray-100 text-gray-600 p-4 rounded-lg shadow-md mb-8">
                    <p class="text-center">No account information found.</p>
                </div>
            @endif
        </div>

        <script>
            function fetchBalance(accountId) {
                // Redirect to the correct route with the accountId
                window.location.href = "{{ route('fetchAccountBalance.account.info', ['accountId' => '__ID__']) }}".replace('__ID__', encodeURIComponent(accountId));
            }
        </script>
    </div>
@endsection
