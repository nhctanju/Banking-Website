@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Currency</h2>
    <form action="{{ route('currencies.update', $currency->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Currency Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $currency->code }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Currency Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $currency->name }}" required>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Exchange Rate (against BDT)</label>
            <input type="number" step="0.000001" name="rate" id="rate" class="form-control" value="{{ $currency->rate }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Currency</button>
    </form>
</div>
@endsection