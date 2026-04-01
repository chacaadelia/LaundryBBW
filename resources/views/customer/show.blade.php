@extends('adminlte::page')

@section('title', 'Detail Customer')

@section('content_header')
    <h1>Detail Customer</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

                {{-- KOLOM KANAN: DATA --}}
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Pelanggan</th>
                            <td>{{ $customer->nama_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>Nomor_Telepon</th>
                            <td>{{ $customer->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $customer->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $customer->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop