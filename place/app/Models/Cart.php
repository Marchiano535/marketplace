<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'jumlahItemYangDiProduk',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Methods
    public function tambahItemKeProduk($productId, $quantity)
    {
        return self::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $productId],
            ['jumlahItemYangDiProduk' => \DB::raw('jumlahItemYangDiProduk + ' . $quantity)]
        );
    }

    public function hapusItemDariProduk($productId)
    {
        return self::where('user_id', auth()->id())
                  ->where('product_id', $productId)
                  ->delete();
    }

    public function calculatePrice()
    {
        return $this->jumlahItemYangDiProduk * $this->product->harga;
    }
}
