@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Milestone</h2>
    <form action="{{ route('milestones.update', $milestone->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $milestone->name }}" required>
        </div>
        <div class="mb-3">
            <label>Target Date</label>
            <input type="date" name="target_date" class="form-control" value="{{ $milestone->target_date }}" required>
        </div>
        <div class="mb-3">
            <label>Deliverable</label>
            <input type="text" name="deliverable" class="form-control" value="{{ $milestone->deliverable }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Pending" {{ $milestone->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ $milestone->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $milestone->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Grant</label>
            <select name="grant_id" class="form-control" required>
                @foreach($grants as $grant)
                <option value="{{ $grant->id }}" {{ $milestone->grant_id == $grant->id ? 'selected' : '' }}>
                    {{ $grant->title }}
                </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
