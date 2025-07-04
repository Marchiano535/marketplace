<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->product->harga * $item->jumlahItemYangDiProduk;
        });

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'jumlahItemYangDiProduk' => 'required|integer|min:1|max:' . $cart->product->stok
        ]);

        $cart->update(['jumlahItemYangDiProduk' => $request->jumlahItemYangDiProduk]);

        return back()->with('success', 'Keranjang berhasil diupdate');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Keranjang kosong');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->harga * $item->jumlahItemYangDiProduk;
        });

        DB::transaction(function () use ($cartItems, $total) {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'PENDING'
            ]);

            // Create order items and update stock
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->jumlahItemYangDiProduk,
                    'price' => $cartItem->product->harga
                ]);

                // Update product stock
                $cartItem->product->decrement('stok', $cartItem->jumlahItemYangDiProduk);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('customer.orders.index')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
