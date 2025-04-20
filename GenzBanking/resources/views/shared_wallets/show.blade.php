@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $sharedWallet->name }}</h2>
    <p><strong>Balance:</strong> ${{ number_format($sharedWallet->balance, 2) }}</p>
    <h4>Members:</h4>
    <ul>
        @foreach($sharedWallet->users as $user)
            <li>{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>
</div>
@endsection

 
