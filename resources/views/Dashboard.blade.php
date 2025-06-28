@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})</h1>

    @if (Auth::user()->role == 'karyawan')
        <form method="POST" action="{{ route('absen.masuk') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Absen Masuk</button>
        </form>
        <form method="POST" action="{{ route('absen.keluar') }}" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-danger">Absen Keluar</button>
        </form>
    @endif

    <hr>
    <h3>Riwayat Absensi</h3>
    <table class="table">
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
        </tr>
        @foreach($absensi as $a)
            <tr>
                <td>{{ $a->user->name }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->jam_masuk ?? '-' }}</td>
                <td>{{ $a->jam_keluar ?? '-' }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
