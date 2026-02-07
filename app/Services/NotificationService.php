<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public static function notifyBidPlaced($bid)
    {
        $car = $bid->car;
        $seller = $car->user;

        // Notify seller about the bid
        Notification::create([
            'user_id' => $seller->id,
            'type' => 'bid_placed',
            'related_id' => $bid->id,
            'related_type' => 'Bid',
            'message' => "{$bid->user->name} placed a bid of \${$bid->bid_amount} on your {$car->make} {$car->model}",
        ]);

        // Notify other bidders that they've been outbid
        $otherBidders = $car->bids()
            ->where('user_id', '!=', $bid->user_id)
            ->distinct('user_id')
            ->pluck('user_id');

        foreach ($otherBidders as $bidderId) {
            Notification::create([
                'user_id' => $bidderId,
                'type' => 'outbid',
                'related_id' => $bid->id,
                'related_type' => 'Bid',
                'message' => "You have been outbid on {$car->make} {$car->model}. New highest bid: \${$bid->bid_amount}",
            ]);
        }
    }

    public static function notifyAppointmentApproved($appointment)
    {
        $car = $appointment->car;
        $buyer = $appointment->user;

        // Notify buyer of approval
        Notification::create([
            'user_id' => $buyer->id,
            'type' => 'appointment_approved',
            'related_id' => $appointment->id,
            'related_type' => 'Appointment',
            'message' => "Your appointment for {$car->make} {$car->model} on {$appointment->appointment_date} has been approved!",
        ]);

        // Notify seller
        Notification::create([
            'user_id' => $car->user->id,
            'type' => 'appointment_approved',
            'related_id' => $appointment->id,
            'related_type' => 'Appointment',
            'message' => "Appointment with {$buyer->name} for {$car->make} {$car->model} on {$appointment->appointment_date} has been approved",
        ]);
    }

    public static function notifyAppointmentRejected($appointment)
    {
        $car = $appointment->car;
        $buyer = $appointment->user;

        // Notify buyer of rejection
        Notification::create([
            'user_id' => $buyer->id,
            'type' => 'appointment_rejected',
            'related_id' => $appointment->id,
            'related_type' => 'Appointment',
            'message' => "Your appointment for {$car->make} {$car->model} on {$appointment->appointment_date} has been rejected.",
        ]);
    }

    public static function notifyCarSold($car)
    {
        // Notify seller
        Notification::create([
            'user_id' => $car->user->id,
            'type' => 'car_sold',
            'related_id' => $car->id,
            'related_type' => 'Car',
            'message' => "Your {$car->make} {$car->model} has been sold!",
        ]);

        // Notify all bidders
        $bidders = $car->bids()->distinct('user_id')->pluck('user_id');
        foreach ($bidders as $bidderId) {
            Notification::create([
                'user_id' => $bidderId,
                'type' => 'car_sold',
                'related_id' => $car->id,
                'related_type' => 'Car',
                'message' => "The {$car->make} {$car->model} you bid on has been sold.",
            ]);
        }
    }
}
