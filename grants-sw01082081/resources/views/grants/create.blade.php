@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Add Grant</h2>
    <form action="{{ route('grants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Provider</label>
            <input type="text" name="provider" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Duration (Months)</label>
            <input type="number" name="duration_months" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Project Leader</label>
            <select name="project_leader_id" class="form-control" required>
                @foreach($academicians as $academician)
                <option value="{{ $academician->id }}">{{ $academician->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
