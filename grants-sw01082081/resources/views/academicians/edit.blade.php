@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Academician</h2>
    <form action="{{ route('academicians.update', $academician->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $academician->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $academician->email }}" required>
        </div>
        <div class="mb-3">
            <label>College</label>
            <input type="text" name="college" class="form-control" value="{{ $academician->college }}" required>
        </div>
        <div class="mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" value="{{ $academician->department }}" required>
        </div>
        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" value="{{ $academician->position }}" required>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
