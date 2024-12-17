@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ $user->full_name }}</h1>
    <p>This is your Employee Dashboard.</p>
</div>
@endsection
