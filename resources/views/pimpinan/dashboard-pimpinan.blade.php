@extends('layouts.app-pimpinan')

@section('navbar-title', 'Barang Masuk')

@section('content')
    <script>
        window.location.href = "{{ url('/pimpinan/barang-masuk') }}";
    </script>
@endsection
