@extends('layouts.admin')
@section('title', 'Service Types')
@section('header', 'Service Types')
@section('subheader', 'Manage service types for cabs like Out Station, Local, etc.')
@section('content')
@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
@endif
<div class="mb-4 flex flex-wrap items-center justify-between gap-3">
    <p class="text-sm text-slate-500">{{ $serviceTypes->total() }} service types</p>
    <a href="{{ route('admin.service-types.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">+ Add Service Type</a>
</div>
<form method="GET" action="{{ route('admin.service-types.index') }}" class="mb-4 flex flex-wrap items-end gap-3 rounded-2xl bg-white p-4 shadow-sm">
    <div class="min-w-[220px] flex-1">
        <label for="service-type-search" class="mb-1 block text-xs font-semibold text-slate-500">Search service types</label>
        <input id="service-type-search" type="search" name="search" value="{{ $validated['search'] ?? '' }}" placeholder="Service type name or slug" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div class="min-w-[160px] flex-shrink-0">
        <label for="service-type-status" class="mb-1 block text-xs font-semibold text-slate-500">Status</label>
        <select id="service-type-status" name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="">All statuses</option>
            <option value="active" {{ ($validated['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ ($validated['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Search</button>
    @if ($validated['search'] ?? null)
        <a href="{{ route('admin.service-types.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm">Clear</a>
    @endif
</form>
<div class="overflow-hidden rounded-2xl bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Slug</th>
                    <th class="px-5 py-3">Cabs Count</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($serviceTypes as $serviceType)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-900">{{ $serviceType->name }}</p>
                            @if ($serviceType->description)
                                <p class="mt-1 max-w-xs text-xs text-slate-500">{{ $serviceType->description }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-mono text-xs text-slate-700">{{ $serviceType->slug }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $serviceType->cabs_count }} cab(s)</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-semibold {{ $serviceType->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($serviceType->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.service-types.edit', $serviceType) }}" class="rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white">Edit</a>
                                <form method="POST" action="{{ route('admin.service-types.destroy', $serviceType) }}" onsubmit="return confirm('Delete this service type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-slate-500">No service types found. Add a service type to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-5">{{ $serviceTypes->links() }}</div>
@endsection