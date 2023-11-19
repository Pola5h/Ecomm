<?php

namespace App\Http\Controllers\backend;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\File;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Datas = Hero::all();

        return view("admin.others.index_hero", compact('Datas'));
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
        // Create a new instance of the hero model
        $hero = new Hero();

        // Directly use the incoming request data
        $hero->small_title = $request->input('small_title');
        $hero->big_title = $request->input('big_title');
        $hero->discount = $request->input('discount');
        $str = 'hero' . uniqid();

        // Handle file upload
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $imageName = $str . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('hero'), $imageName);
            $hero->banner = $imageName;
        }
        $hero->save();

        toastr()->success('hero Inserted successfully');

        // Redirect or respond as needed
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
     // Find the hero by its slug
        $hero = Hero::findorFail($id);

        // Check if the hero exists
        if (!$hero) {
            toastr()->error('Hero not found');

            return redirect()->back();
        }

        // Delete the hero's image
        $imagePath = public_path('hero/' . $hero->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the hero
        $hero->delete();
        toastr()->success('hero deleted successfully');

        // Redirect back to the brand index page with a success message
        return redirect()->back();
    
    }
}
