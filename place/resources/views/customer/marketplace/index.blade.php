@extends('layouts.marketplace')

@section('title', 'Marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form action="{{ route('marketplace.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <!-- Category Filter -->
            <div class="flex-1 min-w-48">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="kategori" id="kategori" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Filter -->
            <div class="flex-1 min-w-48">
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                <select name="sort" id="sort" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Latest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <!-- Search (hidden on mobile, shown on desktop) -->
            <div class="hidden lg:block flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="Search products..." 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Product Image -->
                    <div class="aspect-square bg-gray-200 relative">
                        @if($product->namaFile)
                            <img src="{{ asset('storage/products/' . $product->namaFile) }}" 
                                 alt="{{ $product->nama }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Stock Badge -->
                        @if($product->stok <= 5)
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $product->stok }} left
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <!-- Category -->
                        <div class="text-xs text-blue-600 font-medium mb-1">{{ $product->kategori }}</div>
                        
                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->nama }}</h3>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $product->deskripsi }}</p>
                        
                        <!-- Price -->
                        <div class="text-lg font-bold text-gray-900 mb-3">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('marketplace.show', $product) }}" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition-colors">
                                View Details
                            </a>
                            
                            @auth
                                @if($product->stok > 0)
                                    <form action="{{ route('marketplace.add-to-cart', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="jumlahItemYangDiProduk" value="1">
                                        <button type="submit" 
                                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled 
                                            class="flex-1 bg-gray-300 text-gray-500 py-2 px-4 rounded-md text-sm font-medium cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition-colors">
                                    Login to Buy
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2m16-7H4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
            <div class="mt-6">
                <a href="{{ route('marketplace.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    View All Products
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
