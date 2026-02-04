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
            'bid_amount.gt' => 'Your bid must be higher than the current price of $' . $highestBid,
        ]);

        $car->bids()->create([
            'user_id' => auth::id(),
            'bid_amount' => $request->bid_amount,
        ]);

        return back()->with('success', 'Bid placed successfully!');
    }
}
