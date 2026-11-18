@extends('layouts.admin')
@section('title', 'Cab Details')
@section('header', 'Cab Details')
@section('subheader', 'View the cab registration, service, and pricing details.')
@section('content')
<div class="mb-4 flex justify-end gap-2">
    <a href="{{ route('admin.cabs.index') }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Back to Cabs</a>
    <a href="{{ route('admin.cabs.edit', $cab) }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Edit Cab</a>
</div>
<div class="overflow-hidden rounded-2xl bg-white shadow-sm">
    <dl class="grid grid-cols-1 divide-y divide-slate-100 md:grid-cols-2 md:divide-y-0">
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Cab Name</dt>
            <dd class="mt-1 font-semibold text-slate-900">{{ $cab->name }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Registration Number</dt>
            <dd class="mt-1 font-mono text-slate-900">{{ $cab->registration_number }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Vehicle Type</dt>
            <dd class="mt-1 text-slate-900">{{ $cab->type }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Service Type</dt>
            <dd class="mt-1 text-slate-900">{{ $cab->serviceType?->name ?? 'Not set' }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">City</dt>
            <dd class="mt-1 text-slate-900">{{ $cab->city?->name ?? 'Not set' }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Associate</dt>
            <dd class="mt-1 text-slate-900">{{ $cab->associate?->name ?? 'Admin created' }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Capacity</dt>
            <dd class="mt-1 text-slate-900">{{ $cab->capacity }} seats</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Rate per km</dt>
            <dd class="mt-1 text-slate-900">Rs.{{ number_format($cab->rate_per_km, 2) }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Base Fare</dt>
            <dd class="mt-1 text-slate-900">Rs.{{ number_format($cab->base_fare, 2) }}</dd>
        </div>
        <div class="border-b border-slate-100 px-6 py-4">
            <dt class="text-xs font-semibold uppercase text-slate-500">Status</dt>
            <dd class="mt-1 text-slate-900">{{ ucfirst($cab->status) }}</dd>
        </div>
    </dl>
</div>
@endsection
