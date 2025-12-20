<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
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
        return view('Admin.product');
    }
    public function CreateProduct(Request $request)
    {
        $product = DB::table('product')->create([

        ]);
    }

}
