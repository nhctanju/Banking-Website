@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Shared Wallets</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('shared_wallets.create') }}" class="btn btn-primary mb-3">Create New Shared Wallet</a>

    <ul class="list-group">
        @forelse($sharedWallets as $wallet)
            <li class="list-group-item">
                <a href="{{ route('shared_wallets.show', $wallet) }}">{{ $wallet->name }}</a> - Balance: ${{ number_format($wallet->balance, 2) }}
            </li>
        @empty
            <li class="list-group-item">You have no shared wallets.</li>
        @endforelse
    </ul>
</div>
@endsection

