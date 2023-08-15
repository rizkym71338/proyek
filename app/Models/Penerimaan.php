<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'penerima',
        'pengirim',
        'produk_masuk',
        'satuan',
        "persediaan_id"
    ];
}
