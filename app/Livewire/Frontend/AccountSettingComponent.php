<?php

namespace App\Livewire\Frontend;

use Flasher\Laravel\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AccountSettingComponent extends Component
{

    public function updateAccount(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->address = request('address');

        $user->save();

        // Set the success message to flash
        session()->flash('success_message', 'Account information updated successfully.');

        return redirect()->back();
    }


    
    public function render()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('livewire.frontend.account-setting-component', [
            'user' => $user
        ]);
    }
}
