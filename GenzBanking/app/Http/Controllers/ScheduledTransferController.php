<?php

namespace App\Http\Controllers;

use App\Models\ScheduledTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledTransferController extends Controller
{
    // Show the form to schedule a transfer
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the logged-in user
        return view('scheduled_transfers.create', compact('users'));
    }

    // Store a new scheduled transfer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'scheduled_at' => 'required|date|after:now',
            'description' => 'nullable|string|max:255',
        ]);

        // Ensure the amount is cast to a float
        $validated['amount'] = (float) $validated['amount'];

        ScheduledTransfer::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $validated['recipient_id'],
            'amount' => $validated['amount'],
            'scheduled_at' => $validated['scheduled_at'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('scheduled_transfers.index')->with('success', 'Transfer scheduled successfully.');
    }

    // List all scheduled transfers for the logged-in user
    public function index()
    {
        $scheduledTransfers = ScheduledTransfer::where('sender_id', Auth::id())->get();
        return view('scheduled_transfers.index', compact('scheduledTransfers'));
    }

    // Show the form to edit a scheduled transfer
    public function edit(ScheduledTransfer $scheduledTransfer)
    {
        $this->authorize('update', $scheduledTransfer);

        $users = User::where('id', '!=', Auth::id())->get();
        return view('scheduled_transfers.edit', compact('scheduledTransfer', 'users'));
    }

    // Update a scheduled transfer
    public function update(Request $request, ScheduledTransfer $scheduledTransfer)
    {
        $this->authorize('update', $scheduledTransfer);

        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'scheduled_at' => 'required|date|after:now',
            'description' => 'nullable|string|max:255',
        ]);

        $scheduledTransfer->update($validated);

        return redirect()->route('scheduled_transfers.index')->with('success', 'Scheduled transfer updated successfully.');
    }

    // Cancel a scheduled transfer
    public function destroy(ScheduledTransfer $scheduledTransfer)
    {
        $this->authorize('delete', $scheduledTransfer);

        $scheduledTransfer->update(['status' => 'canceled']);

        return redirect()->route('scheduled_transfers.index')->with('success', 'Scheduled transfer canceled successfully.');
    }
}
