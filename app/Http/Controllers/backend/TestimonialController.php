<?php

namespace App\Http\Controllers\backend;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Testimonial::all();

        return view('admin.others.index_testimonial', compact('data'));
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
            'designation' => 'required|string|max:255',
            'testimonial' => 'required|string', // Change 'text' to 'string' for the testimonial field
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name'] . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('testimonial'), $imageName);
            // You can save the file path in the database if needed
            // For example: $path = 'testimonial/' . $imageName;
        }

        // Create and save the testimonial with the form data
        $testimonial = new Testimonial();
        $testimonial->client_name = $validatedData['name'];
        $testimonial->designation = $validatedData['designation']; // Fix the assignment to 'designation' instead of 'name'
        $testimonial->testimonial = $validatedData['testimonial'];
        $testimonial->image = $imageName; // Use the generated filename
        $testimonial->save();

        // Redirect to a success page or wherever you want
        toastr()->success('Testimonial inserted successfully');

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
    public function edit(string $id)
    {
        $data = Testimonial::all();
        $editData = Testimonial::findOrFail($id);
        return view('admin.others.index_testimonial', compact('data', 'editData'));   
   }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Retrieve the testimonial by id
        $testimonial = Testimonial::findOrFail($id);

        // Validate the form data
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add any necessary validation rules
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Handle the new image upload
            $image = $request->file('image');
            $imageName = Str::slug($request->input('name'), '-') . '.' . $image->getClientOriginalExtension(); // Use the brand name as the image name

            // Specify the directory path
            $imagePath = 'testimonial/' . $imageName;

            // Remove the old image (if exists)
            if ($testimonial->image) {
                $oldImagePath = public_path('testimonial/' . $testimonial->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the image to the public storage path
            $image->move(public_path('testimonial/'), $imageName);

            // Update the brand's icon field with the new image name
            $testimonial->image = $imageName;
        }

    

        // Update other fields
        $testimonial->client_name = $request->input('name');
        $testimonial->designation = $request->input('designation');
        $testimonial->testimonial = $request->input('testimonial');


        // Save the updated category
        $testimonial->save();
        toastr()->success('Brand Updated successfully');

        return redirect()->route('admin.brand.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the brand by its id
        $testimonial = Testimonial::findOrFail($id);

        // Check if the brand exists
        if (!$testimonial) {
            toastr()->error('Brand not found');

            return redirect()->back();
        }

        // Delete the brand's image
        $imagePath = public_path('brand/' . $testimonial->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the brand
        $testimonial->delete();
        toastr()->success('brand deleted successfully');

        // Redirect back to the brand index page with a success message
        return redirect()->back();
    }
}
