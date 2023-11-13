<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordComponent extends Component
{
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->save();

        // Set the success message to flash
        session()->flash('success_message', 'Account information updated successfully.');

        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.frontend.user-password-component');
    }
}
