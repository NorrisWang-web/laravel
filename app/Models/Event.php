<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'event_datetime', 'event_name', 'prefecture_id', 'max_participants', 'icon',
    ];


}
