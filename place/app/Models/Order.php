<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Methods
    public function calculateSubtotal()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    public function checkoutCart($userId)
    {
        // Logic for checkout
        return $this;
    }

    public function createOrder($userId)
    {
        return self::create([
            'user_id' => $userId,
            'total_amount' => 0,
            'status' => 'PENDING'
        ]);
    }

    public function findOrderById($id)
    {
        return self::find($id);
    }
}
