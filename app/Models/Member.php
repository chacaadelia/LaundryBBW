<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'nama_member',
        'no_telepon'
    ];

    // Relasi ke customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}