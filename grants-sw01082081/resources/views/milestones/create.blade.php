@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Add Milestone</h2>
    <form action="{{ route('milestones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Target Date</label>
            <input type="date" name="target_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deliverable</label>
            <input type="text" name="deliverable" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Grant</label>
            <select name="grant_id" class="form-control" required>
                @foreach($grants as $grant)
                <option value="{{ $grant->id }}">{{ $grant->title }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
