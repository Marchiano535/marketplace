<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Price sorting
        if ($request->has('sort')) {
            if ($request->sort == 'price_low') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('harga', 'desc');
            }
        } else {
            $query->latest();
        }

        $products = $query->where('stok', '>', 0)->paginate(12);
        $categories = Product::distinct()->pluck('kategori');

        return view('customer.marketplace.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::where('kategori', $product->kategori)
            ->where('id', '!=', $product->id)
            ->where('stok', '>', 0)
            ->take(4)
            ->get();

        return view('customer.marketplace.show', compact('product', 'relatedProducts'));
    }

    public function addToCart(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'jumlahItemYangDiProduk' => 'required|integer|min:1|max:' . $product->stok
        ]);

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->jumlahItemYangDiProduk + $request->jumlahItemYangDiProduk;
            
            if ($newQuantity > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia');
            }

            $existingCart->update(['jumlahItemYangDiProduk' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'jumlahItemYangDiProduk' => $request->jumlahItemYangDiProduk
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
}
