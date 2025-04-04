<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'satuan',
        'harga_jual',
        'harga_beli',
        'status',
        'keterangan'
    ]; 
}
