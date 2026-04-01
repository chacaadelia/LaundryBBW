@extends('adminlte::page')

@section('title', 'Edit Service')

@section('content_header')
    <h1>Edit Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('service.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" id="nama_layanan" value="{{ $service->nama_layanan }}" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga" value="{{ $service->harga }}">
                </div>

                <div class="form-group">
                    <label for="estimasi_hari">Estimasi Hari</label>
                    <input type="text" name="estimasi_hari" class="form-control" id="estimasi_hari" value="{{ $service->estimasi_hari }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop