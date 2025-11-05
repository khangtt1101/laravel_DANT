<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
        ]);

        $validatedData['user_id'] = $request->user()->id;
        UserAddress::create($validatedData);

        return redirect()->route('profile.edit')->with('status', 'address-added');
    }

    public function destroy(Request $request, UserAddress $address)
    {
        if ($request->user()->id !== $address->user_id) {
            abort(403);
        }
        $address->delete();
        return redirect()->route('profile.edit')->with('status', 'address-deleted');
    }
}