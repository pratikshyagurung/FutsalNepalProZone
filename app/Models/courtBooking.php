<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courtBooking extends Model
{
    use HasFactory;


    protected $fillable = [
        'TotalPrice',
        'Court_ID',
        'Status',
        'Date',
        'User_ID'
    ];

    // Relationship with Court
    public function court()
    {
        return $this->belongsTo(Court::class, 'Court_ID');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID');
    }
}
