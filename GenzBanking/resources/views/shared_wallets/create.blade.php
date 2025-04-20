@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Shared Wallet</h2>
    <form method="POST" action="{{ route('shared_wallets.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Wallet Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <label for="name" class="form-label">Balance</label>
            <input type="text" class="form-control" id="balance" name="balance" required>
        </div>
        <button type="submit" class="btn btn-success">Create Wallet</button>
    </form>
</div>
@endsection
