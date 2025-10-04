<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'queue_number',
        'customer_name',
        'phone_type',
        'damage_description',
        'repair_costs',
        'notes',
        'attachment',
        'user_id',
        'status_confirmation',
        'rejection_notes',
        'status_repair',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
