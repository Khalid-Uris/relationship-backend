<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $category = Category::all();

        return response()->json([
            'status' => 1,
            'category' => $category,
            'product' => $product
        ],200);
        // $product=Product::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|between:2,100',
            'slug'=>'required|string|between:2,100',
            'price'=>'required|string|between:2,100',
            // 'slug'=>'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>0,
                'error'=>$validator->errors()->first(),
                'data'=> ''
            ],422);
        }

        // first Method
        // $category = Category::find($request->category_id);
        // $product = $category->products()->create([
        //     'name'=>$request->name,
        //     'slug'=>Str::slug($request->slug),
        //     'price' => $request->price,
        // ]);

        // second Method
        try {
        $category = Category::find($request->category_id);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->price = $request->price;

       $data = $category->products()->save($product);

        return response()->json([
            'status' => 1,
            'data' => $data,

        ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => $e->getMessage(),

            ],500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //  $product = Product::with('category')->get();
        // //$category = Category::with('products')->get();

        // return response()->json([
        //     'status' => 1,
        //     'data' => $product
        //     //'data' => $category
        // ]);

        //another method
        $category=Category::all();
        $product= Product::find($id);

         return response()->json([
            'status' => 1,
            'category'=>$category,
            'data' => $product
            //'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
