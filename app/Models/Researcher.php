<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{
    use HasFactory;

    protected $table = 'researchers'; // Sesuai dengan nama tabel

    protected $fillable = [
        'name',
        'expertise',
        'orcid',
        'google_scholar',
        'email',
        'phone'
    ];

    // Relasi ke tabel research_datas
    public function researchData()
    {
        return $this->hasMany(ResearchData::class, 'researcher_id');
    }
}
