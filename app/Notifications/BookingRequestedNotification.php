<?php
// app/Notifications/BookingRequestedNotification.php
// app/Notifications/BookingRequestedNotification.php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingRequestedNotification extends Notification
{
    protected $user;
    protected $bookingTime;

    public function __construct($user, $bookingTime)
    {
        $this->user = $user;
        $this->bookingTime = $bookingTime;
    }

    public function via($notifiable)
    {
        return ['database'];  // You can use database or other channels like 'mail'
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'booking_time' => $this->bookingTime,
            'message' => 'A new booking request has been made.',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a new booking request.')
            ->action('View Booking', url('/'))
            ->line('Thank you for using our application!');
    }
}
