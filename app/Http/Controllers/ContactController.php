<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display the Contact page with all items
    public function index()
    {
        $contactItems = Contact::all(); // Fetch all contact items
        return view('pages.contact.contact', compact('contactItems')); // Pass the contact items to the view
    }

    // Show the form to create a new Contact item
    public function create()
    {
        return view('pages.contact.create'); // Path for create view
    }

    // Store a newly created item on the Contact page
    public function store(Request $request)
    {
        // Validate for array input fields
        $request->validate([
            'title.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'temperature_range.*' => 'nullable|string',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Loop through each set of inputs to create multiple items
        for ($i = 0; $i < count($request->title); $i++) {
            if ($request->title[$i] || $request->description[$i]) {
                $contactItem = new Contact;
                $contactItem->title = $request->title[$i];
                $contactItem->description = $request->description[$i];
                $contactItem->temperature_range = $request->temperature_range[$i] ?? null;

                if (isset($request->image_path[$i])) {
                    $imagePath = $request->image_path[$i]->store('images', 'public');
                    $contactItem->image_path = $imagePath;
                }

                $contactItem->save();
            }
        }

        return redirect()->route('contact')->with('success', 'Contact items created successfully.');
    }

    // Show the form to edit an existing Contact item
    public function edit($id)
    {
        $contactItem = Contact::findOrFail($id); // Find the specific contact item
        return view('pages.contact.edit', compact('contactItem'));
    }

    // Update an existing Contact item
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'temperature_range' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $contactItem = Contact::findOrFail($id);
        $contactItem->title = $request->title;
        $contactItem->description = $request->description;
        $contactItem->temperature_range = $request->temperature_range;

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $contactItem->image_path = $imagePath;
        }

        $contactItem->save();

        return redirect()->route('contact')->with('success', 'Contact item updated successfully.');
    }

    // Delete an existing Contact item
    public function destroy($id)
    {
        $contactItem = Contact::findOrFail($id);
        $contactItem->delete();

        return redirect()->route('contact')->with('success', 'Contact item deleted successfully.');
    }
}
