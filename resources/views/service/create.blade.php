@extends('adminlte::page')

@section('title', 'Tambah Service')

@section('content_header')
    <h1>Tambah Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
             <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" id="nama_layanan" required value="{{ old('nama_layanan') }}">
                    @error('nama_layanan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_per_kg">Harga</label>
                    <input type="number" name="harga_per_kg" class="form-control @error('harga_per_kg') is-invalid @enderror" id="harga_per_kg" required placeholder="Contoh: 7000" value="{{ old('harga_per_kg') }}">
                    @error('harga_per_kg')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estimasi_hari">Estimasi Hari</label>
                    <input type="estimasi_hari" name="estimasi_hari" class="form-control @error('estimasi_hari') is-invalid @enderror" id="estimasi_hari" value="{{ old('estimasi_hari') }}">
                    @error('estimasi_hari')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop