@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Product</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Tambah produk baru ke marketplace</p>
        </div>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            
            <!-- Product Name -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="kategori" id="kategori" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    <option value="Electronics" {{ old('kategori') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                    <option value="Clothing" {{ old('kategori') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                    <option value="Books" {{ old('kategori') == 'Books' ? 'selected' : '' }}>Books</option>
                    <option value="Sports" {{ old('kategori') == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="Home & Garden" {{ old('kategori') == 'Home & Garden' ? 'selected' : '' }}>Home & Garden</option>
                    <option value="Food & Beverages" {{ old('kategori') == 'Food & Beverages' ? 'selected' : '' }}>Food & Beverages</option>
                </select>
                @error('kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" step="0.01" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('harga')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stok" id="stok" value="{{ old('stok') }}" min="0" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('stok')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Product Image -->
            <div>
                <label for="namaFile" class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="namaFile" id="namaFile" accept="image/*"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('namaFile')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
