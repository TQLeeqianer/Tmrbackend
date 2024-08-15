<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'status', 'location', 'image', 'pic_contact', 'pic_name', 'event_id',];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
