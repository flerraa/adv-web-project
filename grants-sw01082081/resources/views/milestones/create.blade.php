@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create New Milestone</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('milestones.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
    <label for="grant_id">Research Grant</label>
    <select name="grant_id" id="grant_id" class="form-control" required>
        <option value="">Select Grant...</option>
        @foreach($grants as $grant)
            <option value="{{ $grant->id }}" {{ old('grant_id') == $grant->id ? 'selected' : '' }}>
                {{ $grant->title }} ({{ $grant->projectLeader->name }})
            </option>
        @endforeach
    </select>
    @error('grant_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Milestone Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="target_date" class="form-label">Target Date</label>
                            <input type="date" class="form-control @error('target_date') is-invalid @enderror" 
                                id="target_date" name="target_date" value="{{ old('target_date') }}" required>
                            @error('target_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deliverable" class="form-label">Deliverable</label>
                            <textarea class="form-control @error('deliverable') is-invalid @enderror" 
                                id="deliverable" name="deliverable" rows="3" required>{{ old('deliverable') }}</textarea>
                            @error('deliverable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('milestones.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Milestone</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap-5'
    });

    // Handle grant selection to set valid date range
    $('#grant_id').change(function() {
        const grantId = $(this).val();
        if (grantId) {
            // Fetch grant details via AJAX
            $.get(`/api/grants/${grantId}`, function(grant) {
                const startDate = grant.start_date;
                const endDate = new Date(new Date(startDate).setMonth(new Date(startDate).getMonth() + grant.duration_months));
                
                $('#target_date').attr('min', startDate);
                $('#target_date').attr('max', endDate.toISOString().split('T')[0]);
            });
        }
    });
});
</script>
@endpush
@endsection