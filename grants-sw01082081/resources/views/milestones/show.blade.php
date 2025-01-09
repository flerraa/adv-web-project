@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Milestone Details</h2>
    <p><strong>Name:</strong> {{ $milestone->name }}</p>
    <p><strong>Target Date:</strong> {{ $milestone->target_date }}</p>
    <p><strong>Deliverable:</strong> {{ $milestone->deliverable }}</p>
    <p><strong>Status:</strong> {{ $milestone->status }}</p>
    <p><strong>Grant:</strong> {{ $milestone->grant->title }}</p>

    <a href="{{ route('milestones.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
