@extends('layouts.app')

@section('title', 'Cab Search Results | Tour & Travel')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
        <div class="mb-8">
            <a href="{{ route('cabs.book') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-rose-600 transition">
                <i class="fa-solid fa-arrow-left"></i> Back to search
            </a>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Search Results</h1>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8">
            <h2 class="text-lg font-semibold text-slate-900 mb-6">Your trip details</h2>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                <div class="col-span-2 flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-xs uppercase font-semibold">Pickup City</p>
                        <p class="font-medium text-slate-900">{{ $pickupCity?->name ?? $validated['pickup_city_id'] }}</p>
                    </div>
                </div>

                <div class="col-span-2 flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-xs uppercase font-semibold">Drop City</p>
                        <p class="font-medium text-slate-900">{{ $validated['drop_city'] }}</p>
                    </div>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Pickup Date</dt>
                    <dd class="font-medium text-slate-900">{{ \Illuminate\Support\Carbon::parse($validated['pickup_date'])->format('d M, Y') }}</dd>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Pickup Time</dt>
                    <dd class="font-medium text-slate-900">{{ \Illuminate\Support\Carbon::parse('1970-01-01 '.$validated['pickup_time'])->format('g:i A') }}</dd>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Drop Date</dt>
                    <dd class="font-medium text-slate-900">{{ \Illuminate\Support\Carbon::parse($validated['drop_date'])->format('d M, Y') }}</dd>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Drop Time</dt>
                    <dd class="font-medium text-slate-900">{{ \Illuminate\Support\Carbon::parse('1970-01-01 '.$validated['drop_time'])->format('g:i A') }}</dd>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Service Type</dt>
                    <dd class="font-medium text-slate-900">{{ $validated['service_type'] }}</dd>
                </div>

                <div>
                    <dt class="text-slate-500 text-xs uppercase font-semibold">Vehicle Preference</dt>
                    <dd class="font-medium text-slate-900">{{ $validated['vehicle_type'] ?? 'Any Vehicle Type' }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">
            <p class="font-medium">Coming soon: view available cabs and prices here.</p>
        </div>
    </div>
@endsection
