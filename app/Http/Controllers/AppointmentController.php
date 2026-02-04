<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $request->validate([
            'appointment_date' => 'required|date|after:today',
        ]);

        $car->appointments()->create([
            'user_id' => auth::id(),
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Test drive request sent to the seller!');
    }
}
