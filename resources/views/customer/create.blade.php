@extends('adminlte::page')

@section('title', 'Tambah Customer')

@section('content_header')
    <h1>Tambah Customer</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
             <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" required value="{{ old('nama_pelanggan') }}">
                    @error('nama_pelanggan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" required value="{{ old('nomor_telepon') }}">
                    @error('nomor_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" required placeholder="Contoh: Medan" value="{{ old('alamat') }}">
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop