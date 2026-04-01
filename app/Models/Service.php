<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     use HasFactory;
     protected $fillable = ['nama_layanan','harga_per_kg','estimasi_hari'];

    public function transaksis()
{
    return $this->hasMany(Transaksi::class);
}
}
