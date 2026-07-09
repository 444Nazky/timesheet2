<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = [
        'user_id', 'clock_in', 'clock_out', 'ip_address', 'location', 'status'
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
