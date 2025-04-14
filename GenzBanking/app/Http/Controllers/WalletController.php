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
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'balance' => 'required|numeric|min:0'
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();

        Wallet::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Wallet created successfully!');
    }
    public function store(Request $request)
{
    // Validation and wallet creation logic

    return redirect()->route('dashboard')->with('success', 'Wallet created successfully.');
}

}


