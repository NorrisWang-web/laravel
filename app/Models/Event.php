<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'event_datetime', 'event_name', 'prefecture_id', 'max_participants', 'icon',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }
    
    public function searchEventsByKeyword($keyword, $admin_id)
    {
        $events = Event::where('admin_id', '=', $admin_id)->orWhere('event_name', 'like', "%{$keyword}%");

    }


}
