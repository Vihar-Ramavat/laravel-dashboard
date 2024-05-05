@extends('layouts.dashboard')

@section('dashboard_content')
<div>
    <h1 class="text-2xl font-bold">Welcome to your Dashboard, {{ $user->username }}</h1>
    <p>Your user ID is: {{ $user->id }}</p>
</div>
@endsection