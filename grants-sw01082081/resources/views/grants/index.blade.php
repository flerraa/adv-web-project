@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Grants</h2>
    <a href="{{ route('grants.create') }}" class="btn btn-primary mb-3">Add Grant</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Provider</th>
                <th>Start Date</th>
                <th>Duration (Months)</th>
                <th>Project Leader</th>
                <th>Actions</th>
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
                <td>{{ $grant->projectLeader->name }}</td>
                <td>
                    <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
