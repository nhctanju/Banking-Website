@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Schedule a Transfer</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('scheduled_transfers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="recipient_id" class="form-label">Recipient</label>
            <select name="recipient_id" id="recipient_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" 
                   placeholder="Enter amount" step="0.01" min="0.01" required>
        </div>
        <div class="mb-3">
            <label for="scheduled_at" class="form-label">Scheduled Date & Time</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea name="description" id="description" class="form-control" 
                     placeholder="Enter description"></textarea>
        </div>
        
        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-calendar-plus"></i> Schedule Transfer
            </button>
            <a href="{{ route('scheduled_transfers.index') }}" class="btn btn-outline-primary px-4">
                <i class="bi bi-list-ul"></i> View Scheduled
            </a>
        </div>
    </form>
</div>
@endsection