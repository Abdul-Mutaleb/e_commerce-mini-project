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
        return view("Admin.addCategory");
    }
    // Category added
    public function addCategory(Request $request)
    {
        $request->validate([
            "category_name" => ['required', 'string'],
        ]);

        $category = DB::table("categories")->insert([
            "category_name" => $request->category_name,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        return redirect()->route("Admin.categoryList")->with("success", "Successfully added Category");
    }
    // Category show 

    public function categoryList()
    {
        $categoryList = DB::table("categories")->get();
        return view("Admin.categoryList", compact('categoryList'));
    }

    // Category edit section 
    public function editCategory($id)
    {
        $category = DB::table("categories")->where('id', $id)->first();
        return view("Admin.editCategory", compact("category"));
    }
    // Category update  
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            "category_name" => ["required", "string"],
        ]);

        DB::table("categories")
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
        $room = DB::table('categories')->where('id', $id)->first();
        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('Admin.categoryList')->with('success', 'Category deleted successfully!');
    }

    // Product view section 
    public function product()
    {
        $categories = DB::table('categories')->get();

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
            'category_id' => 'required|exists:categories,id',
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

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('Admin.editProduct', compact('product', 'categories'));
    }

    // Update Product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_id' => 'required|unique:products,product_id,' . $product->id,
            'price' => 'required|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'alert_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->update($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('product_images');
            }
        }

        return redirect()->route('Admin.productList')->with('success', 'Product updated successfully!');
    }

     public function productList()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.product_name',
                'products.price',
                'products.quantity',
                'products.alert_quantity',
                'categories.category_name'
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

    public function deleteProductImage($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }

    

}
