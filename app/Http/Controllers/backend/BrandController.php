<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Brand::all();

        return view('admin.brand.index_brand', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // Add this line for the description field

        ]);
        // Generate a slug from the lowercase version of the brand name
        $slug = Str::slug($validatedData['name'], '-');
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name'] . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('brand'), $imageName);
            // You can save the file path in the database if needed
            // For example: $path = 'brand/' . $imageName;
        }

        // Create and save the brand with the form data
        $brand = new Brand();
        $brand->name = $validatedData['name'];
        $brand->slug = $slug; // Store the slug in the database
        $brand->description = 'null';
        $brand->image = $imageName; // Use the generated filename
        $brand->save();

        // Redirect to a success page or wherever you want
        toastr()->success('Brand Inserted successfully');

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

        $data = Brand::all();
        $editData = Brand::where('slug', $slug)->first();
        return view('admin.brand.index_brand', compact('data', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        // Retrieve the brand by slug
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Validate the form data
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Handle the new image upload
            $image = $request->file('image');
            $imageName = Str::slug($request->input('name'), '-') . '.' . $image->getClientOriginalExtension();

            // Specify the directory path
            $imagePath = 'brand/' . $imageName;

            // Remove the old image (if exists)
            if ($brand->image) {
                $oldImagePath = public_path('brand/' . $brand->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the image to the public storage path
            $image->move(public_path('brand/'), $imageName);

            // Update the brand's icon field with the new image name
            $brand->image = $imageName;
        }

        // Check if the name is being changed
        if ($brand->name !== $request->input('name')) {
            // Name is being changed, so check if the new name already exists
            $existingBrand = Brand::where('name', $request->input('name'))->where('id', '!=', $brand->id)->first();
            if ($existingBrand) {
                // A brand with the same name already exists
                toastr()->error('Brand with this name already exists.');
                return redirect()->back();
            }

            // Update the slug based on the new name
            $slug = Str::slug($request->input('name'), '-');
            $brand->slug = $slug;
        }

        // Update other fields
        $brand->name = $request->input('name');

        // Save the updated category
        $brand->save();

        toastr()->success('Brand updated successfully');

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        // Find the brand by its slug
        $brand = Brand::where('slug', $slug)->first();

        // Check if the brand exists
        if (!$brand) {
            toastr()->error('Brand not found');

            return redirect()->back();
        }

        // Delete the brand's image
        $imagePath = public_path('brand/' . $brand->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the brand
        $brand->delete();
        toastr()->success('brand deleted successfully');

        // Redirect back to the brand index page with a success message
        return redirect()->back();
    }
}
