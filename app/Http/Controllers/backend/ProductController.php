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
        $galleryData = ProductGallery::where('product_id', $productId)->get();

        toastr()->success('Product Inserted successfully');

        // Redirect or respond as needed
        return view("admin.product.gallery", compact('productId', 'galleryData')); // Replace 'your.route.name' with the actual route name you want to redirect to
    }



    public function gallery($id)
    {
        $galleryData = ProductGallery::where('product_id', $id)->get();
        $productId = $id;
        return view('admin.product.gallery', compact('galleryData', 'productId'));
    }

    public function galleryStore(Request $request)
    {
        foreach ($request->input('document', []) as $file) {
            //your file to be uploaded
            return $file;
        }
        toastr()->success('Image Inserted successfully');

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

    public function galleryDelete(string $id)
    {
        $gallery = ProductGallery::findOrFail($id);

        // Get the file path of the gallery image.
        $imagePath = public_path('product/gallery/' . $gallery->image);

        // Delete the file.
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the gallery from the database.
        $gallery->delete();

        // Redirect the user back to the previous page.
        toastr()->success('Image Deleted successfully');

        return redirect()->back();
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
    public function edit(string $slug)
    {


        $data = Product::Where('slug', $slug)->first();
        return view('admin.product.edit_product', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */


     public function update(Request $request, string $slug)
     {
         // Get the Product instance using the provided product ID
         $product = Product::where('slug', $slug)->firstOrFail();
     
         // Update the product attributes using the incoming request data
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
     
         // Generate slug if the product name is updated
         if ($request->input('name') != $product->name) {
             $product->slug = Str::slug($request->input('name'));
         }
     
         // Handle file upload if a new thumbnail is provided
         if ($request->hasFile('thumbnail')) {
             // Delete the existing thumbnail if it exists
             if (!empty($product->thumbnail)) {
                 unlink(public_path('product/thumbnail/' . $product->thumbnail));
             }
     
             // Upload and save the new thumbnail
             $image = $request->file('thumbnail');
             $imageName = $product->slug . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('product/thumbnail'), $imageName);
             $product->thumbnail = $imageName;
         }
     
         // Save the updated product to the database
         $product->save();
     
         toastr()->success('Product Updated successfully');
     
         // Redirect or respond as needed
         return redirect()->route('admin.product.index');
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
