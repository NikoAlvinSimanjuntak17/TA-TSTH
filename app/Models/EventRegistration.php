<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'researcher_id',
        'certificate_link',
    ];

    /**
     * Get the event associated with the registration.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the researcher associated with the registration.
     */
    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }
}
