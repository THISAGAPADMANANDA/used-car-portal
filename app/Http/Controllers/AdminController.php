<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function promoteUser($id)
    {
        $user = User::findOrFail($id);
        $user->role = 1; // 1 = Admin
        $user->save();
        return back()->with('success', 'User promoted to Admin successfully.');
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User removed.');
    }

    public function cars()
    {
        $cars = Car::with('user')->get();
        return view('admin.cars', compact('cars'));
    }

    public function updateCarStatus(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        // Validate input: status can be active, deactivated, or sold
        $car->status = $request->status;
        $car->save();
        return back()->with('success', 'Car status updated.');
    }

    public function appointments()
    {
        // Show appointments with car and bidder details
        $appointments = Appointment::with(['user', 'car.bids'])->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status; // 'approved' or 'rejected'
        $appointment->save();
        return back()->with('success', 'Appointment status updated.');
    }
}
