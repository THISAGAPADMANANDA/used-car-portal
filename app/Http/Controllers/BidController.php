<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $highestBid = $car->bids->max('bid_amount') ?? $car->price;

        $request->validate([
            'bid_amount' => 'required|numeric|gt:' . $highestBid,
        ], [
            'bid_amount.gt' => 'Your bid must be higher than the current price of $' . number_format($highestBid, 2),
        ]);

        $car->bids()->create([
            'user_id' => Auth::id(),
            'bid_amount' => $request->bid_amount,
        ]);

        return back()->with('success', 'Bid placed successfully! You can now request an appointment.');
    }
}
