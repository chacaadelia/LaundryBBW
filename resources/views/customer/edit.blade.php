@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content_header')
    <h1>Edit Customer</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan" value="{{ $customer->nama_pelanggan }}" required>
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" value="{{ $customer->nomor_telepon }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $customer->alamat }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop