<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'email',
        'phone',
        'working_hours',
        'twitter',
        'facebook',
        'pinterest',
        'instagram',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the user who created the contact.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who updated the contact.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
