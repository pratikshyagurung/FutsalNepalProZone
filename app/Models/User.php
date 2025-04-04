<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'dob',
        'address',
        'email',
        'password',
        'role',  // Added role field
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courts()
    {
        return $this->hasMany(Court::class);
    }

    /**
     * Get the bookings made by the user.
     */
    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class, 'User_ID');
    // }

    /**
     * Check if user is a futsal owner
     */
    public function isFutsalOwner()
    {
        return $this->role === 'futsal_owner';
    }

    /**
     * Check if user is a regular user
     */
    public function isRegularUser()
    {
        return $this->role === 'user';
    }

    use Notifiable; // This enables notifications

    public function getNotifications()
    {
        return $this->notifications; // This is built-in with Notifiable trait
    }
    public function statusHistories()
    {
        return $this->hasMany(BookingStatusHistory::class, 'changed_by');
    }
}
