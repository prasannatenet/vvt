@extends('layouts.admin')
@section('title', 'Vehicle Types')
@section('header', 'Vehicle Types')
@section('subheader', 'Manage the vehicle types available for your cabs.')
@section('content')
@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
@endif
<div class="mb-4 flex flex-wrap items-center justify-between gap-3">
    <p class="text-sm text-slate-500">{{ $vehicleTypes->total() }} vehicle types</p>
    <a href="{{ route('admin.vehicle-types.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">+ Add Vehicle Type</a>
</div>
<form method="GET" action="{{ route('admin.vehicle-types.index') }}" class="mb-4 flex flex-wrap items-end gap-3 rounded-2xl bg-white p-4 shadow-sm">
    <div class="min-w-[220px] flex-1">
        <label for="vehicle-type-search" class="mb-1 block text-xs font-semibold text-slate-500">Search vehicle types</label>
        <input id="vehicle-type-search" type="search" name="search" value="{{ $validated['search'] ?? '' }}" placeholder="Vehicle type name" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div class="min-w-[160px] flex-shrink-0">
        <label for="vehicle-type-status" class="mb-1 block text-xs font-semibold text-slate-500">Status</label>
        <select id="vehicle-type-status" name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="">All statuses</option>
            <option value="active" {{ ($validated['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ ($validated['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Search</button>
    @if (($validated['search'] ?? null) || ($validated['status'] ?? null))
        <a href="{{ route('admin.vehicle-types.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm">Clear</a>
    @endif
</form>
<div class="overflow-hidden rounded-2xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[700px] text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Cabs Using</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($vehicleTypes as $vehicleType)
                    <tr>
                        <td class="px-5 py-4 font-semibold text-slate-900">{{ $vehicleType->name }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $vehicleType->cabs_count }} cab(s)</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 rounded px-2.5 py-0.5 text-xs font-semibold {{ $vehicleType->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($vehicleType->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.vehicle-types.edit', $vehicleType) }}" class="rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white">Edit</a>
                                <form method="POST" action="{{ route('admin.vehicle-types.destroy', $vehicleType) }}" onsubmit="return confirm('Delete this vehicle type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-slate-500">No vehicle types found. Add one to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-5">{{ $vehicleTypes->links() }}</div>
@endsection
