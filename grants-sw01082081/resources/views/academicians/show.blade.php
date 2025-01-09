@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Academician Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $academician->name }}</p>
            <p><strong>Email:</strong> {{ $academician->email }}</p>
            <p><strong>College:</strong> {{ $academician->college }}</p>
            <p><strong>Department:</strong> {{ $academician->department }}</p>
            <p><strong>Position:</strong> {{ $academician->position }}</p>
        </div>
    </div>

    <h3>Related Grants</h3>
    @if($grants->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Provider</th>
                    <th>Start Date</th>
                    <th>Duration (Months)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grants as $grant)
                <tr>
                    <td>{{ $grant->title }}</td>
                    <td>${{ number_format($grant->amount, 2) }}</td>
                    <td>{{ $grant->provider }}</td>
                    <td>{{ $grant->start_date }}</td>
                    <td>{{ $grant->duration_months }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No grants associated with this academician.</p>
    @endif

    <a href="{{ route('academicians.index') }}" class="btn btn-primary mt-3">Back</a>
</div>
@endsection
