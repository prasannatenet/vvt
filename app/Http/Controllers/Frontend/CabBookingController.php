<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ServiceType;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class CabBookingController extends Controller
{
    public function create(): View
    {
        $cities = City::orderBy('name')->get();

        $serviceTypes = ServiceType::active()->orderBy('name')->get();

        $vehicleTypes = VehicleType::active()->orderBy('name')->get();

        $minDate = Carbon::today()->toDateString();

        return view('cabs.book', compact(
            'cities',
            'serviceTypes',
            'vehicleTypes',
            'minDate'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pickup_city_id' => ['required', 'integer', 'exists:cities,id'],
            'drop_city' => ['required', 'string', 'max:100'],
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'pickup_time' => ['required', 'date_format:H:i'],
            'drop_date' => ['required', 'date', 'after_or_equal:pickup_date'],
            'drop_time' => ['required', 'date_format:H:i'],
            'service_type' => ['required', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'max:50'],
        ]);

        return redirect()->route('cabs.search', $validated);
    }

    public function search(Request $request): View
    {
        $validated = $request->validate([
            'pickup_city_id' => ['required', 'integer', 'exists:cities,id'],
            'drop_city' => ['required', 'string', 'max:100'],
            'pickup_date' => ['required', 'date'],
            'pickup_time' => ['required', 'date_format:H:i'],
            'drop_date' => ['required', 'date'],
            'drop_time' => ['required', 'date_format:H:i'],
            'service_type' => ['required', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'max:50'],
        ]);

        $pickupCity = City::find($validated['pickup_city_id']);

        return view('cabs.search', compact('validated', 'pickupCity'));
    }
}
