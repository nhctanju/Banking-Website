<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // Specify the table name since it's not the conventional plural
    protected $table = 'wallet';

    protected $fillable = [
        'user_id',
        'name',
        'balance'
    ];

    protected $casts = [
        'balance' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}