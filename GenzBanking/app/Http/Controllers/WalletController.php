<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function showCreateForm()
    {
        return view('create');
    }

    public function createWallet(Request $request)
    {
       

        $request->validate([
            'name' => 'nullable|string|max:255',
            'balance'=>'nullable|string|max:255'
        ]);

        Wallet::create([
            
            'balance' => 0.00,
            'name' => $request->name ?? 'Default Wallet',
        ]);

        return redirect()->route('wallet.create.form')->with('success', 'Wallet created successfully!');
    }
}


