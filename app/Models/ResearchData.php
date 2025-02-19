<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchData extends Model
{
    use HasFactory;

    protected $table = 'research_datas'; // Sesuai dengan nama tabel di database

    protected $fillable = [
        'research_title',
        'abstract',
        'price',
        'research_category_name',
        'research_category_id',
        'researcher_name',
        'researcher_id',
        'year',
        'doi',
        'file_path',
        'time'
    ];

    // Relasi ke tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'research_category_id');
    }

    // Relasi ke tabel researchers
    public function researcher()
    {
        return $this->belongsTo(Researcher::class, 'researcher_id');
    }
}
