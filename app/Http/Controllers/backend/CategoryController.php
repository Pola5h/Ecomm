<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Category::all();
        return view('admin.category.index_category', compact('data'));
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
        ]);
        // Generate a slug from the lowercase version of the category name
        $slug = Str::slug($validatedData['name'], '-');
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name'] . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category'), $imageName);
            // You can save the file path in the database if needed
            // For example: $path = 'category/' . $imageName;
        }

        // Create and save the category with the form data
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = $slug; // Store the slug in the database
        $category->icon = $imageName; // Use the generated filename
        $category->save();

        // Redirect to a success page or wherever you want
        toastr()->success('Category Inserted successfully');

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
        //


        $data = Category::all();
        $editData = Category::where('slug', $slug)->first();
        return view('admin.category.index_category', compact('data', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $slug)
    {
        // Retrieve the category by slug
        $category = Category::where('slug', $slug)->first();

        // Validate the form data
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add any necessary validation rules
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Handle the new image upload
            $image = $request->file('image');
            $imageName = Str::slug($request->input('name'), '-') . '.' . $image->getClientOriginalExtension(); // Use the category name as the image name

            // Specify the directory path
            $imagePath = 'category/' . $imageName;

            // Remove the old image (if exists)
            if ($category->icon) {
                $oldImagePath = public_path('category/' . $category->icon);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the image to the public storage path
            $image->move(public_path('category/'), $imageName);

            // Update the category's icon field with the new image name
            $category->icon = $imageName;
        }

        // Check if the name is being changed
        if ($category->name !== $request->input('name')) {
            // Name is being changed, so check if the new name already exists
            $existingCategory = Category::where('name', $request->input('name'))->first();
            if ($existingCategory && $existingCategory->id !== $category->id) {
                // A category with the same name already exists
                toastr()->error('Category with this name already exists.');
                return redirect()->back();
            }

            // Update the slug based on the new name
            $slug = Str::slug($request->input('name'), '-');
            $category->slug = $slug;
        }

        // Update other fields
        $category->name = $request->input('name');

        // Save the updated category
        $category->save();
        toastr()->success('Category Updated successfully');

        return redirect()->route('admin.category.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        // Find the category by its slug
        $category = Category::where('slug', $slug)->first();

        // Check if the category exists
        if (!$category) {
            toastr()->error('Category not found');

            return redirect()->back();
        }

        // Delete the category's image
        $imagePath = public_path('category/' . $category->icon);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the category
        $category->delete();
        toastr()->success('Category deleted successfully');

        // Redirect back to the category index page with a success message
        return redirect()->back();
    }
}
