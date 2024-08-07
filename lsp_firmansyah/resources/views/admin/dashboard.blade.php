@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <h2>Daftar Mahasiswa yang Belum Diverifikasi</h2>
    <ul>
        @foreach($mahasiswas as $mahasiswa)
        <li>
            {{ $mahasiswa->first_name }} {{ $mahasiswa->last_name }} - {{ $mahasiswa->email }}
            <form action="{{ route('admin.verify', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">Verifikasi</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
@endsection
