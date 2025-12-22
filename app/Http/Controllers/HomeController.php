<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('media')->get();
        
        $categories = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'categories.category_name')
            ->get()
            ->keyBy('id');
        return view('welcome', compact('products',  'categories'));
    }
}
