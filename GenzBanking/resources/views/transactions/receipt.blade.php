<!DOCTYPE html>
<html>
<head>
    <title>Transaction Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Transaction Receipt</h1>
        <p>Transaction ID: {{ $transaction->id }}</p>
    </div>
    <div class="details">
        <p><strong>Date:</strong> {{ $date }}</p>
        <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
        <p><strong>Sender:</strong> {{ $transaction->senderWallet->user->name ?? 'N/A' }}</p>
        <p><strong>Receiver:</strong> {{ $transaction->receiverWallet->user->name ?? 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $transaction->description ?? 'N/A' }}</p>
    </div>
    <div class="footer">
        <p>Thank you for using GenZWallet!</p>
    </div>
</body>
</html>