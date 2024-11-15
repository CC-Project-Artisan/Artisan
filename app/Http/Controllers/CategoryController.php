<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Store the new category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name cannot exceed 255 characters.',
            'name.unique' => 'This category name already exists. Please choose a different name.',
            'description.string' => 'The description must be a valid string.',
        ]);

        // Insert the new category into the database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect back with success message
        return redirect()->route('category.create')->with('success', 'Category added successfully!');
    }
}
