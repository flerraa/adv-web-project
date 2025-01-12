@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Academicians</h2>
        <a href="{{ route('academicians.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Academician
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Staff Number</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Grants (Leader)</th>
                            <th>Grants (Member)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($academicians as $academician)
                        <tr>
                            <td>{{ $academician->name }}</td>
                            <td>{{ $academician->staff_number }}</td>
                            <td>{{ $academician->email }}</td>
                            <td>{{ $academician->position }}</td>
                            <td>{{ $academician->college }}</td>
                            <td>{{ $academician->department }}</td>
                            <td>{{ $academician->ledGrants->count() }}</td>
                            <td>{{ $academician->memberGrants->count() }}</td>
                            <td>
                                <a href="{{ route('academicians.show', $academician->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('academicians.edit', $academician->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('academicians.destroy', $academician->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this academician?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection