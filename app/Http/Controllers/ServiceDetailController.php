<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceDetailController extends Controller
{
    // Show the form for creating a new service detail
    public function create(Service $service)
    {
        if (!$service) {
            abort(404, 'Service not found');
        }
        return view('pages.services.detail.create', compact('service'));
    }

    // Store a newly created service detail
    public function store(Request $request, Service $service)
    {
        if (!$service) {
            abort(404, 'Service not found');
        }

        $request->validate([
            'description' => 'required|string',
            'client' => 'nullable|string',
            'location' => 'nullable|string',
            'year_completed' => 'nullable|date',
            'surface_area' => 'nullable|numeric',
            'value' => 'nullable|numeric',
            'architect' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $data = $request->all();

            // Handle image upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            // Save service detail with the service relationship
            $service->serviceDetails()->create($data);

            return redirect()->route('service.details.show-all', $service->id)
                             ->with('success', 'Service detail created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create the service detail. Please try again.');
        }
    }

    // Show the form for editing a service detail
    public function edit(Service $service, ServiceDetail $serviceDetail)
    {
        if (!$service || !$serviceDetail) {
            abort(404, 'Service or Service Detail not found');
        }
        return view('pages.services.detail.edit', compact('service', 'serviceDetail'));
    }

    // Update the specified service detail
    public function update(Request $request, Service $service, ServiceDetail $serviceDetail)
    {
        if (!$service || !$serviceDetail) {
            abort(404, 'Service or Service Detail not found');
        }

        $request->validate([
            'description' => 'required|string',
            'client' => 'nullable|string',
            'location' => 'nullable|string',
            'year_completed' => 'nullable|date',
            'surface_area' => 'nullable|numeric',
            'value' => 'nullable|numeric',
            'architect' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $data = $request->all();

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($serviceDetail->image) {
                    Storage::disk('public')->delete($serviceDetail->image);
                }
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            // Update the service detail
            $serviceDetail->update($data);

            return redirect()->route('service.details.show-all', $service->id)
                             ->with('success', 'Service detail updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the service detail. Please try again.');
        }
    }

    // Delete the specified service detail
    public function destroy(Service $service, ServiceDetail $serviceDetail)
    {
        if (!$service || !$serviceDetail) {
            abort(404, 'Service or Service Detail not found');
        }

        try {
            // Delete the image if exists
            if ($serviceDetail->image) {
                Storage::disk('public')->delete($serviceDetail->image);
            }
            $serviceDetail->delete();

            return redirect()->route('service.details.show-all', $service->id)
                             ->with('success', 'Service detail deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the service detail. Please try again.');
        }
    }

    // Show a specific service detail
    public function show(Service $service, ServiceDetail $serviceDetail)
    {
        if (!$service || !$serviceDetail) {
            abort(404, 'Service or Service Detail not found');
        }
        return view('pages.services.detail.show', compact('service', 'serviceDetail'));
    }

    // Show all service details for a specific service
    public function showDetail(Service $service)
    {
        if (!$service) {
            abort(404, 'Service not found');
        }
        $serviceDetails = $service->serviceDetails;
        return view('pages.services.detail.show-all', compact('service', 'serviceDetails'));
    }
}
