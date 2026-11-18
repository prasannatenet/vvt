<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceTypeController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $serviceTypes = ServiceType::withCount('cabs')
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('slug', 'like', '%'.$search.'%');
                });
            })
            ->when($validated['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.service-types.index', compact('serviceTypes', 'validated'));
    }

    public function create(): View
    {
        return view('admin.service-types.create');
    }

    public function store(ServiceTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ServiceType::create($validated);

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type added successfully.');
    }

    public function show(ServiceType $serviceType): View
    {
        $serviceType->load('cabs');

        return view('admin.service-types.show', compact('serviceType'));
    }

    public function edit(ServiceType $serviceType): View
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    public function update(ServiceTypeRequest $request, ServiceType $serviceType): RedirectResponse
    {
        $validated = $request->validated();

        $serviceType->update($validated);

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type updated successfully.');
    }

    public function destroy(ServiceType $serviceType): RedirectResponse
    {
        // Check if service type is being used by cabs
        if ($serviceType->cabs->count() > 0) {
            return redirect()->route('admin.service-types.index')
                ->with('error', 'Cannot delete service type. It is being used by '.$serviceType->cabs->count().' cab(s).');
        }

        $serviceType->delete();

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type deleted successfully.');
    }
}
