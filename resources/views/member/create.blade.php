@extends('adminlte::page')

@section('title', 'Tambah Member')

@section('content_header')
    <h1>Tambah Member</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('member.store') }}" method="POST">
            @csrf 

            <div class="form-group">
                <label>Pilih Customer</label>
                <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->nama_pelanggan }} - {{ $customer->no_telepon }}
                        </option>
                    @endforeach
                </select>

                @error('customer_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('member.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@stop