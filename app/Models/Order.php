<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_datas_id',
        'research_title',
        'user_id',
        'nama',
        'shipping_phonenumber',
        'shipping_postalcode',
        'address',
        'shipping_city',
        'file_path',
        'totalprice',
        'status',
        'transaction_status',
        'ulasan',
        'snap_token',
        'time',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
