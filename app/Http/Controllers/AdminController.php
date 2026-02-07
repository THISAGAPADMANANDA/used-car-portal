<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
use App\Models\Contact;
use App\Models\Appointment;
use App\Services\NotificationService;
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

    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->ban();
        return back()->with('success', 'User has been banned successfully.');
    }

    public function unbanUser($id)
    {
        $user = User::findOrFail($id);
        $user->unban();
        return back()->with('success', 'User has been unbanned successfully.');
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
        // Show appointments with car, bidder, and bid details
        $appointments = Appointment::with(['user', 'car', 'bid'])->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::with('car.bids')->findOrFail($id);

        $status = $request->status;

        $requireHighest = $request->boolean('require_highest_bid');

        if ($status === 'approved' && $requireHighest) {
            $car = $appointment->car;

            $highestBid = $car->bids->sortByDesc('bid_amount')->first();

            if (! $highestBid || $highestBid->user_id !== $appointment->user_id) {
                $appointment->status = 'rejected';
                $appointment->save();

                // Notify about rejection
                NotificationService::notifyAppointmentRejected($appointment);

                return back()->with('error', 'Appointment rejected: the appointment user does not hold the highest bid.');
            }
        }

        $appointment->status = $status;
        $appointment->save();

        if ($status === 'approved') {
            // Notify about approval
            NotificationService::notifyAppointmentApproved($appointment);

            $car = $appointment->car;
            if ($car) {
                $car->status = 'sold';
                $car->save();

                // Notify about car being sold
                NotificationService::notifyCarSold($car);
            }

            return back()->with('success', 'Appointment approved and Transaction Finalized (Car marked as Sold).');
        } elseif ($status === 'rejected') {
            // Notify about rejection
            NotificationService::notifyAppointmentRejected($appointment);
        }

        return back()->with('success', 'Appointment status updated to ' . $status . '.');
    }

    public function inquiries()
{

    $inquiries = Contact::latest()->get();
    return view('admin.inquiries', compact('inquiries'));
}

public function deleteInquiry($id)
{
    Contact::destroy($id);
    return back()->with('success', 'Inquiry deleted successfully.');
}
}
