@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Edit Grant</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('grants.update', $grant->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $grant->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                    id="amount" name="amount" value="{{ old('amount', $grant->amount) }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Provider -->
                        <div class="mb-3">
                            <label for="provider" class="form-label">Provider</label>
                            <input type="text" class="form-control @error('provider') is-invalid @enderror" 
                                id="provider" name="provider" value="{{ old('provider', $grant->provider) }}" required>
                            @error('provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" name="start_date" value="{{ old('start_date', $grant->start_date) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label for="duration_months" class="form-label">Duration (Months)</label>
                            <input type="number" class="form-control @error('duration_months') is-invalid @enderror" 
                                id="duration_months" name="duration_months" value="{{ old('duration_months', $grant->duration_months) }}" required>
                            @error('duration_months')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Project Leader -->
                        <div class="mb-3">
                            <label for="project_leader_id" class="form-label">Project Leader</label>
                            <select name="project_leader_id" id="project_leader_id" 
                                class="form-select @error('project_leader_id') is-invalid @enderror" required>
                                <option value="">Select Project Leader...</option>
                                @foreach($academicians as $academician)
                                    <option value="{{ $academician->id }}" 
                                        {{ old('project_leader_id', $grant->project_leader_id) == $academician->id ? 'selected' : '' }}>
                                        {{ $academician->name }} ({{ $academician->staff_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_leader_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('grants.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Update Grant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

