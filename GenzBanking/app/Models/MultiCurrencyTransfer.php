<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiCurrencyTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_wallet_id',
        'receiver_wallet_id',
        'amount',
        'sender_currency',
        'receiver_currency',
        'conversion_rate',
        'fee',
        'converted_amount',
    ];
}
