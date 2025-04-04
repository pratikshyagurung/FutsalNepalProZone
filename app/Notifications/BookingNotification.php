<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Booking;

class BookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Send via email and store in the database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->greeting('Hello!')
            ->line('Your booking has been confirmed.')
            ->action('View Booking', url('/user/bookings'))
            ->line('Thank you for using our service!');
    }


    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'event_id' => $this->booking->event_ID,
            'user_id' => $this->booking->User_ID,
            'total_price' => $this->booking->TotalPrice,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New booking request received!',
            'booking_id' => $this->booking->id,
            'event_id' => $this->booking->event_id,
            'user_id' => $this->booking->user_id,
            'total' => $this->booking->total_amount,
        ];
    }
}
