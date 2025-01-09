@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Grant Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Title:</strong> {{ $grant->title }}</p>
            <p><strong>Amount:</strong> ${{ number_format($grant->amount, 2) }}</p>
            <p><strong>Provider:</strong> {{ $grant->provider }}</p>
            <p><strong>Start Date:</strong> {{ $grant->start_date }}</p>
            <p><strong>Duration (Months):</strong> {{ $grant->duration_months }}</p>
            <p><strong>Project Leader:</strong> {{ $grant->projectLeader->name }}</p>
        </div>
    </div>

    <h3>Related Milestones</h3>
    @if($milestones->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Target Date</th>
                    <th>Deliverable</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($milestones as $milestone)
                <tr>
                    <td>{{ $milestone->name }}</td>
                    <td>{{ $milestone->target_date }}</td>
                    <td>{{ $milestone->deliverable }}</td>
                    <td>{{ $milestone->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No milestones associated with this grant.</p>
    @endif

    <a href="{{ route('grants.index') }}" class="btn btn-primary mt-3">Back</a>
</div>
@endsection
