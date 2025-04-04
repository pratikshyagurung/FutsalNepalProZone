<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $futsalOwner;
    protected $status;
    protected $bookingTime;
    protected $eventName;
    protected $bookingId;

    public function __construct($futsalOwner, $status, $bookingTime, $eventName, $bookingId)
    {
        $this->futsalOwner = $futsalOwner;
        $this->status = $status;
        $this->bookingTime = $bookingTime;
        $this->eventName = $eventName;
        $this->bookingId = $bookingId;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        $notificationData = [
            'futsal_owner_id' => $this->futsalOwner->id,
            'status' => $this->status,
            'booking_time' => $this->bookingTime,
            'court_name' => $this->eventName,
            'booking_id' => $this->bookingId
        ];

        if ($notifiable->role === 'user') {
            $notificationData['message'] = 'Your booking at ' . $this->eventName .
                ' has been ' . $this->status . ' by ' . $this->futsalOwner->name .
                ($this->status === 'confirmed' ? '. Please proceed to checkout.' : '');
            $notificationData['checkout_url'] = $this->status === 'confirmed' ?
                route('checkout', ['id' => $this->bookingId]) : null;
        } else {
            $notificationData['message'] = 'Booking ' . $this->status .
                ' for ' . $this->eventName . ' at ' . $this->bookingTime;
        }

        return $notificationData;
    }

    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject("Booking {$this->status} - {$this->eventName}");

        if ($notifiable->role === 'user') {
            $mail->line("Your booking at {$this->eventName} has been {$this->status}.")
                ->line("Booking Time: {$this->bookingTime}");

            if ($this->status === 'confirmed') {
                $mail->action('Proceed to Checkout', route('checkout', ['id' => $this->bookingId]));
            }
        } else {
            $mail->line("Booking for {$this->eventName} has been {$this->status}.")
                ->line("Booking Time: {$this->bookingTime}");
        }

        return $mail->line('Thank you for using our service!');
    }
}
