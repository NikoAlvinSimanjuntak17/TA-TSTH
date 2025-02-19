<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'researcher_id',
    ];

    /**
     * Get the researcher that owns the project.
     */
    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }
}
