<div class="card mb-4">
    <div class="card-header">
        <h5>Wallet Information</h5>
    </div>
    <div class="card-body">
        <p><strong>Wallet Holder:</strong> {{ auth()->user()->name }}</p>
        @if(auth()->user()->wallet)
            
            <p><strong>Balance:</strong> ${{ number_format(auth()->user()->wallet->balance, 2) }}</p>
        @else
            <p><strong>Balance:</strong> $0.00</p>
        @endif
    </div>
</div>
