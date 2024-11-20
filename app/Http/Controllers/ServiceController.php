<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index()
    {
        $services = Service::all();
        return view('pages.services.service', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        return view('pages.services.create');
    }

    // Store a newly created service in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'temperature_range' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $service = new Service();
            $service->title = $request->title;
            $service->description = $request->description;
            $service->temperature_range = $request->temperature_range;

            if ($request->hasFile('image')) {
                $service->image_path = $request->file('image')->store('images', 'public');
            }

            $service->save();

            return redirect()->route('services.index')->with('success', 'Service created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create the service. Please try again.');
        }
    }

    // Show the form for editing a service
    public function edit(Service $service)
    {
        return view('pages.services.edit', compact('service'));
    }

    // Update the specified service in storage
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'temperature_range' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $service->title = $request->title;
            $service->description = $request->description;
            $service->temperature_range = $request->temperature_range;

            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($service->image_path) {
                    Storage::disk('public')->delete($service->image_path);
                }
                $service->image_path = $request->file('image')->store('images', 'public');
            }

            $service->save();

            return redirect()->route('services.index')->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the service.');
        }
    }

    // Delete the specified service
    public function destroy(Service $service)
    {
        try {
            // Delete the image if exists
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the service.');
        }
    }
}
