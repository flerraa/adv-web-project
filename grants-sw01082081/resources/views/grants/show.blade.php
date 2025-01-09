@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Grant Details</h2>
    <p><strong>Title:</strong> {{ $grant->title }}</p>
    <p><strong>Amount:</strong> ${{ $grant->amount }}</p>
    <p><strong>Provider:</strong> {{ $grant->provider }}</p>
    <p><strong>Start Date:</strong> {{ $grant->start_date }}</p>
    <p><strong>Duration (Months):</strong> {{ $grant->duration_months }}</p>
    <p><strong>Project Leader:</strong> {{ $grant->projectLeader->name }}</p>

    <a href="{{ route('grants.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
