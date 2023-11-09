<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();

        return view('admin.product.index_product', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add_product');

        // return view('admin.product.gallery');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Create a new instance of the Product model
        $product = new Product();

        // Directly use the incoming request data
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->stock_quantity = $request->input('stock_quantity');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->featured = $request->input('featured');
        $product->status = $request->input('status');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');

        // Generate slug
        $productName = Str::slug($request->input('name'));
        $product->slug = $productName;

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = $productName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product/thumbnail'), $imageName);
            $product->thumbnail = $imageName;
        }

        // Save the model to the database

        $product->save();
        $productId = $product->id;

        // Redirect or respond as needed
        return view("admin.product.gallery", compact('productId')); // Replace 'your.route.name' with the actual route name you want to redirect to
    }



    public function gallery($id)
    {
        $galleryData = ProductGallery::where('product_id', $id)->get();
        $productId = $id;

        return view('admin.product.gallery', compact('galleryData','productId'));
    }

    public function galleryStore(Request $request)
    {
        foreach ($request->input('document', []) as $file) {
            //your file to be uploaded
            return $file;
        }
        return redirect()->back();
    }

    public function galleryUpload(Request $request)
    {
        $path = public_path('product/gallery');
        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        // Assuming you have a model for your product gallery, you can do something like this:
        $productGallery = new ProductGallery();
        $productGallery->product_id = $request->input('product'); // Replace 'product_id' with the actual field name
        $productGallery->image = $name; // Assuming 'image' is the field where you store the file names
        $productGallery->save();
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
