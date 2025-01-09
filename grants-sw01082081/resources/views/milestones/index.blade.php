@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Milestones</h2>
    <a href="{{ route('milestones.create') }}" class="btn btn-primary mb-3">Add Milestone</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Target Date</th>
                <th>Deliverable</th>
                <th>Status</th>
                <th>Grant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($milestones as $milestone)
            <tr>
                <td>{{ $milestone->name }}</td>
                <td>{{ $milestone->target_date }}</td>
                <td>{{ $milestone->deliverable }}</td>
                <td>{{ $milestone->status }}</td>
                <td>{{ $milestone->grant->title }}</td>
                <td>
                    <a href="{{ route('milestones.show', $milestone->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" style="display:inline;">
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
