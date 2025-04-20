<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedWallet extends Model
{
    protected $fillable = ['name', 'balance'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'shared_wallet_user', 'shared_wallet_id', 'user_id');
    }
}
