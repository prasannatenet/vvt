@extends('layouts.admin')
@section('title', 'Edit Service Type')
@section('header', 'Edit Service Type')
@section('subheader', 'Edit the service type details')
@section('content')
@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
@endif
<form method="POST" action="{{ route('admin.service-types.update', $serviceType) }}" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm space-y-4">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="mb-1 block text-xs font-semibold text-slate-500">Service Type Name <span class="text-red-500">*</span></label>
            <input id="name" name="name" required value="{{ $serviceType->name }}" placeholder="e.g. Out Station, Local" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="slug" class="mb-1 block text-xs font-semibold text-slate-500">Slug <span class="text-red-500">*</span></label>
            <input id="slug" name="slug" required value="{{ $serviceType->slug }}" placeholder="e.g. out-station, local" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
    
    <div>
        <label for="description" class="mb-1 block text-xs font-semibold text-slate-500">Description</label>
        <textarea id="description" name="description" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ $serviceType->description }}</textarea>
        @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    
    <div>
        <label for="status" class="mb-1 block text-xs font-semibold text-slate-500">Status <span class="text-red-500">*</span></label>
        <select id="status" name="status" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="active" {{ $serviceType->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $serviceType->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

    <div class="flex justify-end">
        <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">Update Service Type</button>
        <a href="{{ route('admin.service-types.index') }}" class="ml-2 rounded-lg bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Cancel</a>
    </div>
</form>
@endsection