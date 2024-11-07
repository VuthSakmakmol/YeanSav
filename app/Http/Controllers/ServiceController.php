<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::all();
    return view('pages.service.service', compact('services')); // Ensure this path matches
}

    

    public function create()
    {
        return view('pages.create'); // Renamed view to pages.service-create
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'temperature_range.*' => 'nullable|string',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        for ($i = 0; $i < count($request->title); $i++) {
            if ($request->title[$i] || $request->description[$i]) {
                $service = new Service;
                $service->title = $request->title[$i];
                $service->description = $request->description[$i];
                $service->temperature_range = $request->temperature_range[$i] ?? null;

                if (isset($request->image_path[$i])) {
                    $imagePath = $request->image_path[$i]->store('images', 'public');
                    $service->image_path = $imagePath;
                }

                $service->save();
            }
        }

        return redirect()->route('service')->with('success', 'Service items created successfully.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('pages.edit', compact('service')); // Renamed view to pages.service-edit
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'temperature_range' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->temperature_range = $request->temperature_range;

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $service->image_path = $imagePath;
        }

        $service->save();

        return redirect()->route('service')->with('success', 'Service item updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service')->with('success', 'Service item deleted successfully.');
    }
}
