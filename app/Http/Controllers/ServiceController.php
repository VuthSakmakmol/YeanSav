<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Fetch all services from the database
        $services = Service::all();

        // Pass the $services variable to the view
        return view('pages.service', compact('services'));
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image',
            'temperature_range' => 'nullable|string|max:50',
            'description' => 'required|string',
        ]);

        $path = $request->file('image_path')->store('images', 'public');
        
        Service::create([
            'title' => $request->title,
            'image_path' => $path,
            'temperature_range' => $request->temperature_range,
            'description' => $request->description,
        ]);

        return redirect()->route('service');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'nullable|image',
            'temperature_range' => 'nullable|string|max:50',
            'description' => 'required|string',
        ]);

        $service = Service::findOrFail($id);
        if ($request->hasFile('image_path')) {
            $service->image_path = $request->file('image_path')->store('images', 'public');
        }
        
        $service->update($request->only('title', 'temperature_range', 'description'));

        return redirect()->route('service');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        
        return redirect()->route('service');
    }
}
