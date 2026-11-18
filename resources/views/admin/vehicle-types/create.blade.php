@extends('layouts.admin')
@section('title', 'Create Vehicle Type')
@section('header', 'Create Vehicle Type')
@section('subheader', 'Add a vehicle type for your cabs.')
@section('content')
<form method="POST" action="{{ route('admin.vehicle-types.store') }}" class="space-y-4 rounded-2xl bg-white p-6 shadow-sm">
    @csrf
    <div>
        <label for="name" class="mb-1 block text-xs font-semibold text-slate-500">Vehicle Type Name <span class="text-red-500">*</span></label>
        <input id="name" name="name" required value="{{ old('name') }}" placeholder="e.g. SUV, Sedan, Hatchback" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        @error('name')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="status" class="mb-1 block text-xs font-semibold text-slate-500">Status <span class="text-red-500">*</span></label>
        <select id="status" name="status" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex justify-end gap-2">
        <a href="{{ route('admin.vehicle-types.index') }}" class="rounded-lg bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Cancel</a>
        <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">Create Vehicle Type</button>
    </div>
</form>
@endsection
