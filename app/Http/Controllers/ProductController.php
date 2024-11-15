<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    //Create a new product listing
    public function index()
    {
        $categories = Category::all();
        return view('pages.create-listing-form', compact('categories'));
    }

    //Store the new product listing
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'productPrice' => 'required|numeric',
            'productCategory' => 'required|string|max:255',
            'productQuantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
            'dimensions' => 'required|string|max:255',
            'productImages.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
            'category_id' => 'required|exists:categories,id', // Validate category ID
        ]);

        $imageNames = [];
        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        Product::create([
            'user_id' => Auth::user()->id,
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productPrice' => $request->productPrice,
            'productCategory' => $request->productCategory,
            'productQuantity' => $request->productQuantity,
            'productImages' => json_encode($imageNames), // Store as JSON
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'category_id' => $request->category_id, // Store category ID
        ]);

        return redirect()->route('dashboard', ['#myAdverts'])->with('success', 'Product created successfully.');
    }
}
