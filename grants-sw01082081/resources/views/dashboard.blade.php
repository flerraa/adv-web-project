@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Research Grant Management Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row">
        <!-- Active Grants -->
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Active Grants</h6>
                            <h2 class="my-2">{{ $activeGrantsCount }}</h2>
                        </div>
                        <i class="fas fa-file-contract fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('grants.index') }}">View Details</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>

        <!-- Total Academicians -->
        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Academicians</h6>
                            <h2 class="my-2">{{ $academiciansCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('academicians.index') }}">View Details</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>

        <!-- Pending Milestones -->
        <div class="col-md-3">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Pending Milestones</h6>
                            <h2 class="my-2">{{ $pendingMilestonesCount }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('milestones.index') }}">View Details</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>

        <!-- Total Grant Amount -->
        <div class="col-md-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Grant Amount</h6>
                            <h2 class="my-2">${{ number_format($totalGrantAmount, 2) }}</h2>
                        </div>
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('grants.index') }}">View Details</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Milestones -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-flag me-1"></i>
            Upcoming Milestones
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Milestone</th>
                            <th>Grant</th>
                            <th>Target Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingMilestones as $milestone)
                            <tr>
                                <td>{{ $milestone->name }}</td>
                                <td>{{ $milestone->grant->title }}</td>
                                <td>{{ $milestone->target_date->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $milestone->status == 'Completed' ? 'success' : 'warning' }}">
                                        {{ $milestone->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No upcoming milestones.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection