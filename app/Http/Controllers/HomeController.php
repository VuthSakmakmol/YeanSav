<?php

namespace App\Http\Controllers;

use App\Models\Home; // Ensure Home model exists
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Display the Home page with all items
    public function index()
    {
        // Fetch all items for the Home page
        $homeItems = Home::all();
        
        // Pass the $homeItems variable to the view
        return view('pages.home.home', compact('homeItems')); // Adjusted path
    }

    // Show the form to create a new item on the Home page
    public function create()
    {
        return view('pages.home.create'); // Adjusted path
    }

    // Store a newly created item on the Home page
    public function store(Request $request)
{
    // Adjust validation for array input fields
    $request->validate([
        'title.*' => 'nullable|string|max:255',
        'description.*' => 'nullable|string',
        'temperature_range.*' => 'nullable|string',
        'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Loop through each set of inputs
    for ($i = 0; $i < count($request->title); $i++) {
        // Create a new Home item only if title or description is provided
        if ($request->title[$i] || $request->description[$i]) {
            $homeItem = new Home;
            $homeItem->title = $request->title[$i];
            $homeItem->description = $request->description[$i];
            $homeItem->temperature_range = $request->temperature_range[$i] ?? null;

            // Handle image upload if provided
            if (isset($request->image_path[$i])) {
                $imagePath = $request->image_path[$i]->store('images', 'public');
                $homeItem->image_path = $imagePath;
            }

            $homeItem->save();
        }
    }

    // Redirect back to the Home page
    return redirect()->route('home')->with('success', 'Home items created successfully.');
}


    // Show the form to edit an existing item on the Home page
    public function edit($id)
    {
        $homeItem = Home::findOrFail($id);
        
        return view('pages.home.edit', compact('homeItem')); // Adjusted path
    }

    // Update an existing item on the Home page
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'temperature_range' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $homeItem = Home::findOrFail($id);
        $homeItem->title = $request->title;
        $homeItem->description = $request->description;
        $homeItem->temperature_range = $request->temperature_range;

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $homeItem->image_path = $imagePath;
        }

        $homeItem->save();

        return redirect()->route('home')->with('success', 'Home item updated successfully.');
    }

    // Delete an existing item from the Home page
    public function destroy($id)
    {
        $homeItem = Home::findOrFail($id);
        $homeItem->delete();

        return redirect()->route('home')->with('success', 'Home item deleted successfully.');
    }
}
