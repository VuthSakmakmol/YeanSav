<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // Display the About page with all items
    public function index()
    {
        $aboutItems = About::all(); // Fetch all about items
        return view('pages.about.about', compact('aboutItems')); // Pass the about items to the view
    }

    // Show the form to create a new About item
    public function create()
    {
        return view('pages.about.create'); // Adjusted path for create view
    }

    // Store a newly created item on the About page
    public function store(Request $request)
    {
        // Adjust validation for array input fields
        $request->validate([
            'title.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'temperature_range.*' => 'nullable|string',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Loop through each set of inputs to create multiple items
        for ($i = 0; $i < count($request->title); $i++) {
            if ($request->title[$i] || $request->description[$i]) {
                $aboutItem = new About;
                $aboutItem->title = $request->title[$i];
                $aboutItem->description = $request->description[$i];
                $aboutItem->temperature_range = $request->temperature_range[$i] ?? null;

                if (isset($request->image_path[$i])) {
                    $imagePath = $request->image_path[$i]->store('images', 'public');
                    $aboutItem->image_path = $imagePath;
                }

                $aboutItem->save();
            }
        }

        return redirect()->route('about')->with('success', 'About items created successfully.');
    }

    // Show the form to edit an existing About item
    public function edit($id)
    {
        $aboutItem = About::findOrFail($id); // Find the specific about item
        return view('pages.about.edit', compact('aboutItem')); // Pass the item to the edit view
    }

    // Update an existing About item
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'temperature_range' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutItem = About::findOrFail($id);
        $aboutItem->title = $request->title;
        $aboutItem->description = $request->description;
        $aboutItem->temperature_range = $request->temperature_range;

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $aboutItem->image_path = $imagePath;
        }

        $aboutItem->save();

        return redirect()->route('about')->with('success', 'About item updated successfully.');
    }

    // Delete an existing About item
    public function destroy($id)
    {
        $aboutItem = About::findOrFail($id);
        $aboutItem->delete();

        return redirect()->route('about')->with('success', 'About item deleted successfully.');
    }
}
