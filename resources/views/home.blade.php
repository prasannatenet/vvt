@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl">
            <!-- Hero Heading -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600 text-white mb-4">
                    <i class="fa-solid fa-plane-departure text-2xl"></i>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-3">Welcome to Tour & Travel</h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Select one of the services below to get started with
                    your journey.</p>
            </div>

            <!-- Selection Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Package Card -->
                <a href="{{ route('packages.index') }}"
                    class="group relative rounded-2xl border-2 border-slate-200 bg-white p-3 p-8 text-center shadow-sm hover:shadow-xl hover:border-indigo-600 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="mx-auto w-20 h-20 rounded-2xl bg-indigo-50 flex items-center justify-center mb-5 group-hover:bg-indigo-600 transition-colors duration-300">
                        <i
                            class="fa-solid fa-suitcase-rolling text-3xl text-indigo-600 group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">Holiday
                        Packages</h2>
                    <p class="text-slate-600 mb-6">
                        Explore our travel services and find the perfect option for your next journey. Plan your trip with
                        ease and enjoy a comfortable travel experience.
                    </p> <span
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 text-white text-sm font-semibold group-hover:bg-indigo-700 transition-colors">
                        Browse Packages
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </a>

                <!-- Cab Booking Card -->
                <a href="{{ route('cabs.book') }}"
                    class="group relative rounded-2xl border-2 border-slate-200 bg-white p-3 p-8 text-center shadow-sm hover:shadow-xl hover:border-emerald-600 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="mx-auto w-20 h-20 rounded-2xl bg-emerald-50 flex items-center justify-center mb-5 group-hover:bg-emerald-600 transition-colors duration-300">
                        <i
                            class="fa-solid fa-car-side text-3xl text-emerald-600 group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-emerald-600 transition-colors">Cab
                        Booking</h2>
                    <p class="text-slate-600 mb-6">
                        Explore our travel services and find the perfect option for your next journey. Plan your trip with
                        ease and enjoy a comfortable travel experience.
                    </p> <span
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white text-sm font-semibold group-hover:bg-emerald-700 transition-colors">
                        Book a Cab
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </a>
            </div>

            <!-- Additional Links -->
            <div class="mt-12 text-center">
                <p class="text-sm text-slate-500">
                    Are you a partner?
                    <a href="{{ route('hotel.login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Hotel
                        Login</a>
                    <span class="mx-2 text-slate-300">|</span>
                    <a href="{{ route('admin.login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Admin
                        Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection