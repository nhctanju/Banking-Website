<?php

namespace App\Http\Controllers;

use App\Models\SharedWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharedWalletController extends Controller
{
    public function index()
    {
        $sharedWallets = Auth::user()->sharedWallets;
        return view('shared_wallets.index', compact('sharedWallets'));
    }

    public function create()
    {
        return view('shared_wallets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0'
        ]);

        $sharedWallet = SharedWallet::create([
            'name' => $request->name,
            'balance' => 0,
        ]);

        $sharedWallet->users()->attach(Auth::id());

        return redirect()->route('shared_wallets.show')->with('success', 'Shared wallet created successfully.');
    }

    public function show(SharedWallet $sharedWallet)
{
    // More efficient authorization check
    if (!auth()->user()->sharedWallets->contains($sharedWallet)) {
        abort(403, 'You do not have access to this shared wallet');
    }

    // Eager load relationships you'll need in the view
    $sharedWallet->load(['user']);

    return view('shared_wallets.show', compact('sharedWallet'));
}
}
