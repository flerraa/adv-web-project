@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Academician Details</h2>
    <p><strong>Name:</strong> {{ $academician->name }}</p>
    <p><strong>Email:</strong> {{ $academician->email }}</p>
    <p><strong>College:</strong> {{ $academician->college }}</p>
    <p><strong>Department:</strong> {{ $academician->department }}</p>
    <p><strong>Position:</strong> {{ $academician->position }}</p>

    <a href="{{ route('academicians.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
