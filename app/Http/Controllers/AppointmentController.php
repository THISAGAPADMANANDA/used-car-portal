<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $userBid = $car->bids()
            ->where('user_id', Auth::id())
            ->orderBy('bid_amount', 'desc')
            ->first();

        if (!$userBid) {
            return back()->with('error', 'Action Required: You must submit a bid for this car before you can request a test drive appointment.');
        }

        $request->validate([
            'appointment_date' => 'required|date|after:today',
        ]);

        $car->appointments()->create([
            'user_id' => Auth::id(),
            'bid_id' => $userBid->id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Success! Your test drive request has been sent and linked to your bid of $' . number_format($userBid->bid_amount, 2));
    }
}
