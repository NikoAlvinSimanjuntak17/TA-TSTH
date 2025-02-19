<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'researcher_id',
        'project_id',
        'interest',
        'status',
    ];

    /**
     * Get the researcher associated with the registration.
     */
    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }

    /**
     * Get the research project associated with the registration.
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class, 'project_id');
    }
}
