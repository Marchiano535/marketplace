<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin accounts are now created by AdminSeeder
        
        // Create Customer Users
        User::create([
            'username' => 'customer1',
            'name' => 'John Doe',
            'full_name' => 'John Doe Customer',
            'email' => 'customer1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Surabaya, Indonesia',
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'rating' => 5,
        ]);

        User::create([
            'username' => 'customer2',
            'name' => 'Jane Smith',
            'full_name' => 'Jane Smith Customer',
            'email' => 'customer2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'address' => 'Medan, Indonesia',
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'rating' => 4,
        ]);

        // Create Sample Products
        Product::create([
            'nama' => 'Laptop Gaming ASUS ROG',
            'kategori' => 'Electronics',
            'harga' => 15000000.00,
            'stok' => 10,
            'deskripsi' => 'Laptop gaming dengan spesifikasi tinggi untuk gaming dan kerja berat',
            'namaFile' => 'laptop-asus-rog.jpg',
        ]);

        Product::create([
            'nama' => 'Smartphone Samsung Galaxy',
            'kategori' => 'Electronics',
            'harga' => 8000000.00,
            'stok' => 25,
            'deskripsi' => 'Smartphone flagship dengan kamera berkualitas tinggi',
            'namaFile' => 'samsung-galaxy.jpg',
        ]);

        Product::create([
            'nama' => 'Kaos Polo Premium',
            'kategori' => 'Clothing',
            'harga' => 250000.00,
            'stok' => 50,
            'deskripsi' => 'Kaos polo berbahan cotton premium dengan kualitas terbaik',
            'namaFile' => 'kaos-polo.jpg',
        ]);

        Product::create([
            'nama' => 'Buku Programming Laravel',
            'kategori' => 'Books',
            'harga' => 150000.00,
            'stok' => 30,
            'deskripsi' => 'Buku panduan lengkap untuk belajar Laravel framework',
            'namaFile' => 'buku-laravel.jpg',
        ]);

        Product::create([
            'nama' => 'Sepatu Running Nike',
            'kategori' => 'Sports',
            'harga' => 1200000.00,
            'stok' => 15,
            'deskripsi' => 'Sepatu running dengan teknologi terdepan untuk kenyamanan maksimal',
            'namaFile' => 'sepatu-nike.jpg',
        ]);
    }
}
