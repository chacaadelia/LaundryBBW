@extends('adminlte::page')

@section('title', 'Detail Service')

@section('content_header')
    <h1>Detail Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
                {{-- KOLOM KANAN: DATA --}}
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Layanan</th>
                            <td>{{ $service->nama_layanan }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ $service->harga }}</td>
                        </tr>
                        <tr>
                            <th>Estimasi Hari</th>
                            <td>{{ $service->estimasi_hari ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $service->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('service.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop