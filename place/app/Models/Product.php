<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'stok',
        'deskripsi',
        'namaFile',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // Relationships
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Methods
    public function addProduct($nama, $kategori, $harga, $stok, $deskripsi)
    {
        return self::create([
            'nama' => $nama,
            'kategori' => $kategori,
            'harga' => $harga,
            'stok' => $stok,
            'deskripsi' => $deskripsi,
        ]);
    }

    public function deleteProduct()
    {
        return $this->delete();
    }

    public function getler()
    {
        return $this;
    }

    public function seller()
    {
        return $this;
    }
}
