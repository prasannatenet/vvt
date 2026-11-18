@extends('layouts.admin')
@section('title', 'Create Service Type')
@section('header', 'Create Service Type')
@section('subheader', 'Add a new service type for cabs')
@section('content')
@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
@endif
<form method="POST" action="{{ route('admin.service-types.store') }}" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="mb-1 block text-xs font-semibold text-slate-500">Service Type Name <span class="text-red-500">*</span></label>
            <input id="name" name="name" required value="{{ old('name') }}" placeholder="e.g. Out Station, Local" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="slug" class="mb-1 block text-xs font-semibold text-slate-500">Slug <span class="text-red-500">*</span></label>
            <input id="slug" name="slug" required value="{{ old('slug') }}" placeholder="e.g. out-station, local" readonly class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-slate-100 text-slate-600 cursor-not-allowed">
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="description" class="mb-1 block text-xs font-semibold text-slate-500">Description</label>
        <textarea id="description" name="description" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ old('description') }}</textarea>
        @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="mb-1 block text-xs font-semibold text-slate-500">Status <span class="text-red-500">*</span></label>
        <select id="status" name="status" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex justify-end">
        <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">Create Service Type</button>
        <a href="{{ route('admin.service-types.index') }}" class="ml-2 rounded-lg bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Cancel</a>
    </div>
</form>

@push('scripts')
<script>
(function () {
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');

    if (!nameInput || !slugInput) {
        return;
    }

    function generateSlug(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9 ]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    nameInput.addEventListener('input', function () {
        // Auto-update the read-only slug whenever the name changes.
        slugInput.value = generateSlug(nameInput.value);
    });
})();
</script>
@endpush
@endsection