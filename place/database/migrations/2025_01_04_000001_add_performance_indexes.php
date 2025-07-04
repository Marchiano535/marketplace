<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index(['email', 'status']);
            $table->index('username');
            $table->index('role');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('kategori');
            $table->index(['harga', 'stok']);
            $table->index('nama');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->index(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email', 'status']);
            $table->dropIndex(['username']);
            $table->dropIndex(['role']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
            $table->dropIndex(['harga', 'stok']);
            $table->dropIndex(['nama']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'product_id']);
        });
    }
};
