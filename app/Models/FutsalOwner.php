<?php
// app/Models/FutsalOwner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FutsalOwner extends Model
{
    use HasFactory, Notifiable;
    use Notifiable;


    // Define the table name if it's not the plural form of the model name
    protected $table = 'futsal_owners';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name', // Add other necessary fields
    ];

    // Relationship with notifications
    public function notifications()
    {
        return $this->morphMany(\Illuminate\Notifications\DatabaseNotification::class, 'notifiable');
    }
    // Define the relationship with bookings (One-to-Many)
    public function bookings()
    {
        return $this->hasMany(eventBooking::class);
    }
}
