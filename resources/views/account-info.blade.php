@extends('layouts.app')

@section('title', 'Account Information')

@section('content')
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Account Information</h2>

            <style>
                .account-card {
                    background: white;
                    padding: 1.5rem;
                    border-radius: 12px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .account-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
                }

                .fetch-balance-btn {
                    display: inline-block;
                    width: 100%;
                    background: linear-gradient(90deg, #2563eb, #1e40af);
                    color: white;
                    padding: 0.75rem;
                    font-size: 1rem;
                    border-radius: 8px;
                    text-align: center;
                    transition: background 0.3s ease, transform 0.2s ease;
                }

                .fetch-balance-btn:hover {
                    background: linear-gradient(90deg, #1e40af, #1e3a8a);
                    transform: scale(1.02);
                }

                .alert {
                    padding: 1rem;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                .alert-error {
                    background: #fee2e2;
                    color: #b91c1c;
                    border-left: 5px solid #dc2626;
                }

                .alert-info {
                    background: #f3f4f6;
                    color: #4b5563;
                    border-left: 5px solid #6b7280;
                }
            </style>

            @if(isset($accountData) && !empty($accountData['data']['accounts']))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($accountData['data']['accounts'] as $account)
                        <div class="account-card">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $account['referenceName'] }}</h3>
                            <h3 class="text-gray-600 mb-4">{{ $account['accountId'] }}</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <strong class="text-gray-700">Account Number:</strong>
                                    <p class="text-gray-600">{{ $account['accountNumber'] }}</p>
                                </div>

                                <div>
                                    <strong class="text-gray-700">Account Holder:</strong>
                                    <p class="text-gray-600">{{ $account['accountName'] }}</p>
                                </div>

                                <div>
                                    <strong class="text-gray-700">Product Name:</strong>
                                    <p class="text-gray-600">{{ $account['productName'] }}</p>
                                </div>

                                <div>
                                    <strong class="text-gray-700">KYC Compliant:</strong>
                                    <p class="text-gray-600">{{ $account['kycCompliant'] ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>

                            <button onclick="fetchBalance('{{ $account['accountId'] }}')" class="fetch-balance-btn mt-4">
                                Fetch Balance
                            </button>
                        </div>
                    @endforeach
                </div>
            @elseif(isset($error))
                <div class="alert alert-error">
                    <p class="font-semibold">Error:</p>
                    <p>{{ $error }}</p>
                </div>
            @else
                <div class="alert alert-info">
                    <p class="text-center">No account information found.</p>
                </div>
            @endif
        </div>

        <script>
            function fetchBalance(accountId) {
                window.location.href = "{{ route('fetchAccountBalance.account.info', ['accountId' => '__ID__']) }}".replace('__ID__', encodeURIComponent(accountId));
            }
        </script>
    </div>
@endsection
