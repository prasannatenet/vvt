@extends('layouts.app')

@section('title', 'Book a Cab | Tour & Travel')

@section('content')
    <div class="bg-gradient-to-br from-rose-50 via-indigo-50 to-cyan-50 min-h-screen py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="mx-auto max-w-xl text-center mb-10">
                <h1 class="text-3xl font-bold tracking-tight text-black sm:text-4xl">Book Your Cab</h1>
                <p class="mt-3 text-black">Find the perfect ride for your journey.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-6 sm:p-8">
                <form method="POST" action="{{ route('cabs.book.store') }}"
                    class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 gap-x-6">
                    @csrf

                    <div class="sm:col-span-2">
                        <label for="pickup_city_id" class="block text-sm font-medium text-black mb-2">Pickup City</label>
                        <select name="pickup_city_id" id="pickup_city_id"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('pickup_city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pickup_city_id')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="drop_city" class="block text-sm font-medium text-black mb-2">Drop City</label>
                        <input type="text" name="drop_city" id="drop_city" list="cities-list"
                            placeholder="Select or type a city" value="{{ old('drop_city') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                        <datalist id="cities-list">
                            @foreach ($cities as $city)
                                <option value="{{ $city->name }}"></option>
                            @endforeach
                        </datalist>
                        <p class="mt-1 text-xs text-black">Do not see your city? Write it.</p>
                        @error('drop_city')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pickup_date" class="block text-sm font-medium text-black mb-2">Pickup Date</label>
                        <input type="date" name="pickup_date" id="pickup_date" min="{{ $minDate }}"
                            value="{{ old('pickup_date') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                        @error('pickup_date')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pickup_time" class="block text-sm font-medium text-black mb-2">Pickup Time</label>
                        <input type="time" name="pickup_time" id="pickup_time" value="{{ old('pickup_time') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                        @error('pickup_time')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="drop_date" class="block text-sm font-medium text-black mb-2">Drop Date</label>
                        <input type="date" name="drop_date" id="drop_date" min="{{ $minDate }}"
                            value="{{ old('drop_date') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                        @error('drop_date')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="drop_time" class="block text-sm font-medium text-black mb-2">Drop Time</label>
                        <input type="time" name="drop_time" id="drop_time" value="{{ old('drop_time') }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                        @error('drop_time')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="service_type" class="block text-sm font-medium text-black mb-2">Service Type</label>
                        <select name="service_type" id="service_type"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                            <option value="">Select a service</option>
                            @foreach ($serviceTypes as $type)
                                <option value="{{ $type->name }}" {{ old('service_type') == $type->name ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_type')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="vehicle_type" class="block text-sm font-medium text-black mb-2">Vehicle Preference (Optional)</label>
                        <select name="vehicle_type" id="vehicle_type"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-black focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition">
                            <option value="">Any Vehicle Type</option>
                            @foreach ($vehicleTypes as $type)
                                @if ($type->name !== 'Any Vehicle Type')
                                    <option value="{{ $type->name }}" {{ old('vehicle_type') == $type->name ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <p class="mt-1 text-xs text-black">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2 pt-4">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-700 hover:to-rose-600 text-black font-bold text-lg py-4 rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 active:translate-y-0">
                            Search Available Cabs <span aria-hidden="true">→</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
