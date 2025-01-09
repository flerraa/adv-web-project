@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Milestone Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $milestone->name }}</p>
            <p><strong>Target Date:</strong> {{ $milestone->target_date }}</p>
            <p><strong>Deliverable:</strong> {{ $milestone->deliverable }}</p>
            <p><strong>Status:</strong> {{ $milestone->status }}</p>
        </div>
    </div>

    <h3>Related Grant</h3>
    <div class="card">
        <div class="card-body">
            <p><strong>Title:</strong> {{ $grant->title }}</p>
            <p><strong>Provider:</strong> {{ $grant->provider }}</p>
            <p><strong>Amount:</strong> ${{ number_format($grant->amount, 2) }}</p>
        </div>
    </div>

    <a href="{{ route('milestones.index') }}" class="btn btn-primary mt-3">Back</a>
</div>
@endsection
