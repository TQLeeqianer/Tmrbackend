<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'person_in_charge', 'sponsor',
        'file_path', 'detail', 'status', 'location',
        'event_map_image', 'event_address_1', 'event_address_2', 'event_postal_code',
        'image', 'start_time', 'end_time', 'start_date', 'end_date',

    ];
}
