@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Edit Milestone</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('milestones.update', $milestone->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Grant Info (Read-only) -->
                        <div class="mb-3">
                            <label class="form-label">Research Grant</label>
                            <input type="text" class="form-control" value="{{ $milestone->grant->title }}" disabled>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Milestone Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $milestone->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Target Date -->
                        <div class="mb-3">
                            <label for="target_date" class="form-label">Target Date</label>
                            <input type="date" class="form-control @error('target_date') is-invalid @enderror" 
                                id="target_date" name="target_date" 
                                value="{{ old('target_date', $milestone->target_date->format('Y-m-d')) }}" 
                                min="{{ $milestone->grant->start_date->format('Y-m-d') }}"
                                max="{{ $milestone->grant->start_date->addMonths($milestone->grant->duration_months)->format('Y-m-d') }}"
                                required>
                            @error('target_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deliverable -->
                        <div class="mb-3">
                            <label for="deliverable" class="form-label">Deliverable</label>
                            <textarea class="form-control @error('deliverable') is-invalid @enderror" 
                                id="deliverable" name="deliverable" rows="3" required>{{ old('deliverable', $milestone->deliverable) }}</textarea>
                            @error('deliverable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Pending" {{ old('status', $milestone->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ old('status', $milestone->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ old('status', $milestone->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Update Milestone</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection