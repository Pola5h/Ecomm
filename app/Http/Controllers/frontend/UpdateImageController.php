<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateImageController extends Controller
{


    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'real-file' => 'required|file|max:500|mimes:jpg,png',
        ]);

        if ($request->file('real-file')) {
            $user = Auth::user(); // Get the current user

            // If the user already has a profile photo, delete it
            if ($user->image) {
                unlink(public_path('images/' . $user->image));
            }

            // Store the new profile photo in the 'public/images' directory
            $file = $request->file('real-file');
            $filename = $file->getClientOriginalName();
            $filePath = 'images/' . $filename;
            $file->move(public_path('images'), $filename);
            $user->image = $filename;
            $user->save();


            // Update the user's profile photo in the database
        }

        // Redirect or return response
        return redirect()->back();
    }
}
