<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'courtName',
        'courtLocation',
        // 'latitude',
        // 'longitude',
        'courtMap',
        'courtPrice',
        'courtAvailability',
        'courtService',
        'courtDescription',
        'image',
        'user_id',
    ];

    public function getEmbedMapUrl()
    {
        $url = $this->courtMap;

        // Handle short URLs
        if (str_contains($url, 'maps.app.goo.gl')) {
            $headers = get_headers($url, 1);
            $url = $headers['Location'] ?? $url; // Get final URL after redirect
        }

        // Standard conversion logic remains same
        if (str_contains($url, '/embed?')) {
            return $url;
        }
        // ... rest of your existing method
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
