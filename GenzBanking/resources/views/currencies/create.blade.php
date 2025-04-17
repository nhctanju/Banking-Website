@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Initiate Multi-Currency Transfer</h2>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (BDT)</label>
            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount in BDT" required>
        </div>
        <div class="mb-3">
            <label for="destination_currency" class="form-label">Recipient's Currency</label>
            <select name="destination_currency" id="destination_currency" class="form-control" required>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->code }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose (Optional)</label>
            <textarea name="purpose" id="purpose" class="form-control" placeholder="Enter purpose of transfer"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Transfer</button>
    </form>
</div>

<div class="container">
    <h2>Add New Currency</h2>

    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Currency Code</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Enter currency code (e.g., USD)" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Currency Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter currency name (e.g., US Dollar)" required>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Exchange Rate (against BDT)</label>
            <input type="number" step="0.000001" name="rate" id="rate" class="form-control" placeholder="Enter exchange rate" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Currency</button>
    </form>
</div>
@endsection