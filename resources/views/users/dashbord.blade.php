@extends('layouts.app')

@section('content')
    <h1>Welcome to the User Dashboard</h1>

    <h2>Your Roles</h2>
    @foreach (auth()->user()->roles as $role)
        <span class="badge badge-primary">{{ $role->name }}</span>
    @endforeach

   
@endsection
