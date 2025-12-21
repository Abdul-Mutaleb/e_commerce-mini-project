<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Validator};
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Product;
class AdminController extends Controller
{

    // Category view section 
    public function category()
    {
        return view("Admin.category");
    }
    // Category added
    public function addCategory(Request $request)
    {
        $request->validate([
            "category_name" => ['required', 'string'],
        ]);

        $category = DB::table("categores")->insert([
            "category_name" => $request->category_name,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        return redirect()->route("Admin.categoryList")->with("success", "Successfully added Category");
    }
    // Category show 

    public function categoryList()
    {
        $categoryList = DB::table("categores")->get();
        return view("Admin.categoryList", compact('categoryList'));
    }

    // Category edit section 
    public function editCategory($id)
    {
        $category = DB::table("categores")->where('id', $id)->first();
        return view("Admin.editCategory", compact("category"));
    }
    // Category update  
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            "category_name" => ["required", "string"],
        ]);

        DB::table("categores")
            ->where("id", $id)
            ->update([
                "category_name" => $request->category_name,
                "updated_at" => now(),
            ]);

        return redirect()->route("Admin.categoryList")->with("success", "Category update Successfuly");

    }
    // Category delete 
    public function deleteCategory($id)
    {
        $room = DB::table('categores')->where('id', $id)->first();
        DB::table('categores')->where('id', $id)->delete();

        return redirect()->route('Admin.categoryList')->with('success', 'Category deleted successfully!');
    }

    // Product view section 
    public function product()
    {
        $categories = DB::table('categores')->get();

        return view('Admin.addProduct', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_id' => 'required|unique:products,product_id',
            'price' => 'required|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'alert_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categores,id',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::create($request->except('images'));

        foreach ($request->file('images') as $image) {
            $product->addMedia($image)->toMediaCollection('product_images');
        }

        return redirect()->route('Admin.addProduct')->with('success', 'Product added successfully!');
    }

    public function productList()
    {
        $products = DB::table('products')
            ->join('categores', 'products.category_id', '=', 'categores.id')
            ->select(
                'products.id',
                'products.product_name',
                'products.price',
                'products.quantity',
                'categores.category_name'
            )
            ->get();

        return view('Admin.productList', compact('products'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->clearMediaCollection('product_images');
        $product->delete();
        return redirect()->route('Admin.productList')
            ->with('success', 'Product deleted successfully');
    }





}
