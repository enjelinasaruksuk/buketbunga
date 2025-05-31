<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'tblproduk'; // sesuaikan dengan nama tabel Anda
    public $timestamps = false; // menonaktifkan created_at dan updated_at
    
    protected $fillable = [
        'nama',
        'harga', 
        'deskripsi'
    ];
}