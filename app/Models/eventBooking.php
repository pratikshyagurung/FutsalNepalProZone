<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventBooking extends Model
{
    use HasFactory;


    protected $fillable = [

        'TotalPrice',
        'Event_ID',
        'Status',
        'Date',
        'User_ID'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID');
    }
}
