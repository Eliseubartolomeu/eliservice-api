<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends BaseUuidModel
{
    protected $fillable = [
        'user_id', 'service_id', 'date', 'start_time', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
