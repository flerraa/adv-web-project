@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Grant</h2>
    <form action="{{ route('grants.update', $grant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $grant->title }}" required>
        </div>

        <!-- Amount -->
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $grant->amount }}" required>
        </div>

        <!-- Provider -->
        <div class="mb-3">
            <label>Provider</label>
            <input type="text" name="provider" class="form-control" value="{{ $grant->provider }}" required>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $grant->start_date }}" required>
        </div>

        <!-- Duration -->
        <div class="mb-3">
            <label>Duration (Months)</label>
            <input type="number" name="duration_months" class="form-control" value="{{ $grant->duration_months }}" required>
        </div>

        <!-- Project Leader -->
        <div class="mb-3">
            <label>Project Leader</label>
            <select name="project_leader_id" class="form-control" required>
                @foreach($academicians as $academician)
                <option value="{{ $academician->id }}" {{ $grant->project_leader_id == $academician->id ? 'selected' : '' }}>
                    {{ $academician->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Grant</button>
    </form>
</div>
@endsection
