<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'nomor_telepon',
        'alamat'
    ];

    // 1 customer hanya punya 1 member
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    // 1 customer punya banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'customer_id');
    }
}