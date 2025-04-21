@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Multi-Currency Transfer</h2>

    {{-- Success & Error Feedback --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-warning">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('multi-currency.transfer') }}" method="POST">
        @csrf

{{-- Sender Wallet --}}
<div class="mb-3">
    <label for="sender_wallet_id" class="form-label">Sender Wallet</label>
    <select name="sender_wallet_id" id="sender_wallet_id" class="form-control" required>
        <option value="" disabled selected>Select Wallet</option>
        @foreach ($wallets as $wallet)
            <option 
                value="{{ $wallet->id }}" 
                data-balance="{{ $wallet->balance }}" 
                data-currency="{{ $wallet->currency }}" 
                data-exchange-rate="{{ $wallet->exchange_rate }}">
                {{ $wallet->name }} - {{ $wallet->id }} (Balance: {{ $wallet->balance }} {{ $wallet->currency }})
            </option>
        @endforeach
    </select>
</div>



        {{-- Amount Input --}}
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input 
                type="number" 
                name="amount" 
                id="amount" 
                class="form-control" 
                placeholder="Enter amount" 
                value="{{ old('amount') }}"
                step="0.01" 
                min="0.01" 
                required
            >
        </div>

        {{-- Convert To --}}
        <div class="mb-3">
            <label for="convert_to_currency" class="form-label">Convert To</label>
            <select name="convert_to_currency" id="convert_to_currency" class="form-control" required>
                <option value="" disabled selected>Select Currency</option>
                @foreach ($currencies as $currency)
                    <option 
                        value="{{ $currency->code }}" 
                        data-exchange-rate="{{ $currency->exchange_rate }}">
                        {{ $currency->code }} (Rate: {{ $currency->exchange_rate }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Converted Balance Display --}}
        <div class="mb-3">
            <label for="converted_balance" class="form-label">Converted Balance</label>
            <input type="text" id="converted_balance" class="form-control" readonly>
        </div>

        {{-- Fee Display --}}
        <div class="mb-3">
            <label for="conversion_fee" class="form-label">5% Conversion Fee</label>
            <input type="text" id="conversion_fee" class="form-control" readonly>
        </div>

        {{-- Hidden Inputs for Required Fields --}}
        <input type="hidden" name="conversion_rate" id="conversion_rate">
        <input type="hidden" name="converted_amount" id="hidden_converted_balance">
        <input type="hidden" name="currency" id="hidden_currency">

        {{-- Receiver --}}
        <div class="mb-3">
            <label for="receiver_wallet_id" class="form-label">Receiver Wallet ID or Phone</label>
            <input 
                type="text" 
                name="receiver_wallet_id" 
                id="receiver_wallet_id" 
                class="form-control" 
                placeholder="Enter wallet ID or phone number"
                value="{{ old('receiver_wallet_id') }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
</div>

{{-- JavaScript for calculating conversion and fee --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const senderWalletSelect = document.getElementById('sender_wallet_id');
        const convertToCurrencySelect = document.getElementById('convert_to_currency');
        const amountInput = document.getElementById('amount');
        const convertedBalanceInput = document.getElementById('converted_balance');
        const conversionFeeInput = document.getElementById('conversion_fee');
        const hiddenConvertedBalanceInput = document.getElementById('hidden_converted_balance');
        const hiddenConversionRateInput = document.getElementById('conversion_rate');
        const hiddenCurrencyInput = document.getElementById('hidden_currency');

        function calculateConversion() {
            const selectedWallet = senderWalletSelect.options[senderWalletSelect.selectedIndex];
            const selectedCurrency = convertToCurrencySelect.options[convertToCurrencySelect.selectedIndex];
            const amount = parseFloat(amountInput.value) || 0;
            const senderExchangeRate = parseFloat(selectedWallet.getAttribute('data-exchange-rate')) || 1;
            const targetExchangeRate = parseFloat(selectedCurrency.getAttribute('data-exchange-rate')) || 1;

            if (amount > 0 && senderExchangeRate > 0 && targetExchangeRate > 0) {
                const converted = (amount / senderExchangeRate) * targetExchangeRate; // Convert to target currency
                const fee = converted * 0.05; // 5% fee

                convertedBalanceInput.value = `${converted.toFixed(2)} ${selectedCurrency.value}`;
                conversionFeeInput.value = `${fee.toFixed(2)} ${selectedCurrency.value}`;

                // Update hidden inputs
                hiddenConvertedBalanceInput.value = converted.toFixed(2);
                hiddenConversionRateInput.value = targetExchangeRate.toFixed(2);
                hiddenCurrencyInput.value = selectedCurrency.value;
            } else {
                convertedBalanceInput.value = '';
                conversionFeeInput.value = '';
                hiddenConvertedBalanceInput.value = '';
                hiddenConversionRateInput.value = '';
                hiddenCurrencyInput.value = '';
            }
        }

        senderWalletSelect.addEventListener('change', calculateConversion);
        convertToCurrencySelect.addEventListener('change', calculateConversion);
        amountInput.addEventListener('input', calculateConversion);
    });
</script>
@endsection
