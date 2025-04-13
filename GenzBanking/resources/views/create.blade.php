@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Wallet</h2>

    @if (session('message'))
        <div class="alert alert-warning">{{ session('message') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('wallet.create') }}" method="POST">
        @csrf
        <!-- Optional: Wallet name -->
        <div class="form-group mb-3">
            <label for="wallet_name">Wallet Name (optional)</label>
            <input type="text" class="form-control" id="wallet_name" name="name" placeholder="My Wallet" required>
            <label for="balance">balance </label>
            <input type="number" class="form-control" id="balance" name="balance" placeholder="0000" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Wallet</button>
    </form>
</div>
@endsection
