@extends('layouts.app')

@section('title', 'Data Satuan')

@section('content')
    <div class="container">
        <h3>Data Satuan</h3>
        <table class="table table-bordered mt-3">
            <thead class="bg-success text-white">
                <tr>
                    <th>ID Satuan</th>
                    <th>Nama Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row['id'] }}</td>
                        <td>{{ $row['nama'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
