<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'CUSTOMER')->count();
        $pendingOrders = Order::where('status', 'PENDING')->count();
        
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders', 
            'totalCustomers',
            'pendingOrders',
            'recentOrders'
        ));
    }

    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with('user', 'orderItems.product')
            ->latest()
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
}
