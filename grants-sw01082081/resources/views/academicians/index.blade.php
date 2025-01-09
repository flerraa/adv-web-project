@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Academicians</h2>
    <a href="{{ route('academicians.create') }}" class="btn btn-primary mb-3">Add Academician</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>College</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($academicians as $academician)
            <tr>
                <td>{{ $academician->name }}</td>
                <td>{{ $academician->email }}</td>
                <td>{{ $academician->college }}</td>
                <td>
                    <a href="{{ route('academicians.show', $academician->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('academicians.edit', $academician->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('academicians.destroy', $academician->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
