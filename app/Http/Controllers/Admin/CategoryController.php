<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\ResearchData;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'message' => 'List of categories',
            'categories' => $categories
        ], 200);
    }

    /**
     * Tambah kategori baru
     */
    public function store(Request $request)
    {

        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['message' => 'Access denied! Only admins can add categories.'], 403);
        }
        
        $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'message' => 'Category added successfully!',
            'category' => $category
        ], 201);
    }

    /**
     * Tampilkan detail kategori berdasarkan ID
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'message' => 'Category details',
            'category' => $category
        ], 200);
    }

    /**
     * Update kategori berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['message' => 'Access denied! Only admins can add categories.'], 403);
        }
        
        $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->update([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'message' => 'Category updated successfully!',
            'category' => $category
        ], 200);
    }

    /**
     * Hapus kategori berdasarkan ID
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['message' => 'Access denied! Only admins can add categories.'], 403);
        }
        
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Cek apakah ada produk yang menggunakan kategori ini
        if (ResearchData::where('product_category_id', $category->id)->exists()) {
            return response()->json([
                'message' => 'Cannot delete, category is used by products'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully!'
        ], 200);
    }

    /**
     * Mengirim notifikasi pesanan baru ke admin
     */
    public function notifyAdmin()
    {
        $admin = Auth::user();

        if (!$admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $orders = Order::all();
        foreach ($orders as $order) {
            $notif = $admin->notifications()->where('data->id', $order->id)->first();
            if (!$notif) {
                $admin->notify(new OrderNotification($order));
            }
        }

        return response()->json([
            'message' => 'Notifications sent successfully!'
        ], 200);
    }
}
