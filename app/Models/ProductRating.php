<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $table = 'product_ratings';

    // Tambahkan properti fillable jika Anda ingin mengizinkan mass assignment
    // protected $fillable = ['product_id', 'rating'];
}