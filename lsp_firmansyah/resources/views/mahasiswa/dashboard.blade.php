@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mahasiswa Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
</div>
@endsection
