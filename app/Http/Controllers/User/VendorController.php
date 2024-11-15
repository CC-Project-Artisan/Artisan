<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function registerVendor(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'nullable|string',
            'business_category' => 'nullable|string',
            'business_phone' => 'required|string|max:255|unique:vendors',
            'business_email' => 'required|string|email|max:255|unique:vendors',
            'business_address' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Create a new Vendor entry
        $vendor = new Vendor([
            'user_id' => $user->id,
            'business_name' => $request->business_name,
            'business_description' => $request->business_description,
            'business_category' => $request->business_category,
            'business_phone' => $request->business_phone,
            'business_email' => $request->business_email,
            'business_address' => $request->business_address,
        ]);

        $vendor->save();

        // Update the user's role to 'vendor'
        $user->role = 'vendor';
        $request->user()->save();

        // Redirect to the vendor dashboard
        return redirect()->route('dashboard')->with('success', 'Vendor profile created successfully.');
    }

    // update store details
    public function updateStoreDetails(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'nullable|string',
            'business_category' => 'nullable|string',
            'business_phone' => 'required|string|max:255',
            'business_email' => 'required|string|email|max:255',
            'business_address' => 'nullable|string',
        ]);

        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if ($vendor) {
            $vendor->business_name = $request->business_name;
            $vendor->business_description = $request->business_description;
            $vendor->business_category = $request->business_category;
            $vendor->business_phone = $request->business_phone;
            $vendor->business_email = $request->business_email;
            $vendor->business_address = $request->business_address;

            $vendor->save();

            return redirect()->route('dashboard')->with('success', 'Store details updated successfully.');
        }

        return redirect()->route('dashboard')->with('error', 'Vendor profile not found.');
    }
}