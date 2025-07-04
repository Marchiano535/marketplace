@extends('layouts.marketplace')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Shopping Cart</h1>
        <a href="{{ route('marketplace.index') }}" 
           class="text-blue-600 hover:text-blue-800 font-medium">
            ← Continue Shopping
        </a>
    </div>

    @if($cartItems->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Cart Items -->
            <div class="divide-y divide-gray-200">
                @foreach($cartItems as $item)
                    <div class="p-6 flex items-center space-x-4">
                        <!-- Product Image -->
                        <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden">
                            @if($item->product->namaFile)
                                <img src="{{ asset('storage/products/' . $item->product->namaFile) }}" 
                                     alt="{{ $item->product->nama }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900">{{ $item->product->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->product->kategori }}</p>
                            <p class="text-lg font-semibold text-gray-900 mt-1">
                                Rp {{ number_format($item->product->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Quantity -->
                        <div class="flex items-center space-x-2">
                            <form action="{{ route('customer.cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <label class="text-sm text-gray-700">Qty:</label>
                                <input type="number" name="jumlahItemYangDiProduk" 
                                       value="{{ $item->jumlahItemYangDiProduk }}" 
                                       min="1" max="{{ $item->product->stok }}"
                                       class="w-16 text-center border border-gray-300 rounded-md py-1">
                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Update
                                </button>
                            </form>
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-900">
                                Rp {{ number_format($item->product->harga * $item->jumlahItemYangDiProduk, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Remove Button -->
                        <div>
                            <form action="{{ route('customer.cart.destroy', $item) }}" method="POST" 
                                  onsubmit="return confirm('Remove this item from cart?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="bg-gray-50 p-6 border-t">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xl font-semibold text-gray-900">Total:</span>
                    <span class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex space-x-4">
                    <a href="{{ route('marketplace.index') }}" 
                       class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-4 rounded-lg font-medium">
                        Continue Shopping
                    </a>
                    <form action="{{ route('customer.cart.checkout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
            <p class="text-gray-500 mb-6">Start shopping to add items to your cart</p>
            <a href="{{ route('marketplace.index') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
