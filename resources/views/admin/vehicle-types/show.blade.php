@extends('admin.layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $vehicleType->name }}</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $vehicleType->name }}</dt>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <span class="badge bg-{{ $vehicleType->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($vehicleType->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Created At</dt>
                        <dd class="col-sm-9">{{ $vehicleType->created_at ? $vehicleType->created_at->format('M d, Y h:i A') : 'N/A' }}</dd>

                        <dt class="col-sm-3">Updated At</dt>
                        <dd class="col-sm-9">{{ $vehicleType->updated_at ? $vehicleType->updated_at->format('M d, Y h:i A') : 'N/A' }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.vehicle-types.index') }}"
                        class="btn btn-outline-primary">
                        <i class="fas fa-backward me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>