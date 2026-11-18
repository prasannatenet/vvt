<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleTypeRequest;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VehicleTypeController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $vehicleTypes = VehicleType::withCount('cabs')
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%');
                });
            })->when($validated['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.vehicle-types.index', compact('vehicleTypes', 'validated'));
    }

    public function create(): View
    {
        return view('admin.vehicle-types.create');
    }

    public function store(VehicleTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        VehicleType::create($validated);

        return redirect()->route('admin.vehicle-types.index')
            ->with('success', 'Vehicle type added successfully.');
    }

    public function show(VehicleType $vehicleType): View
    {
        return view('admin.vehicle-types.show', compact('vehicleType'));
    }

    public function edit(VehicleType $vehicleType): View
    {
        return view('admin.vehicle-types.edit', compact('vehicleType'));
    }

    public function update(VehicleTypeRequest $request, VehicleType $vehicleType): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $vehicleType): void {
            if ($vehicleType->name !== $validated['name']) {
                $vehicleType->cabs()->update(['type' => $validated['name']]);
            }

            $vehicleType->update($validated);
        });

        return redirect()->route('admin.vehicle-types.index')
            ->with('success', 'Vehicle type updated successfully.');
    }

    public function destroy(VehicleType $vehicleType): RedirectResponse
    {
        $cabCount = $vehicleType->cabs()->count();

        if ($cabCount > 0) {
            return redirect()->route('admin.vehicle-types.index')
                ->with('error', 'Cannot delete. It is being used by '.$cabCount.' cab(s).');
        }

        $vehicleType->delete();

        return redirect()->route('admin.vehicle-types.index')
            ->with('success', 'Vehicle type deleted successfully.');
    }
}
