
@extends('adminlte::page')

@section('title', 'Edit Transaksi')

@section('content_header')
<h1>Edit Transaksi</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $transaksi->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->nama_pelanggan }}
                        </option>
                    @endforeach
                </select>
                  {{-- STATUS MEMBER --}}
                <small class="mt-2 d-block">
                    @if($transaksi->customer && $transaksi->customer->member)
                        <span class="badge badge-success">Member (Diskon 10%)</span>
                    @else
                        <span class="badge badge-secondary">Non Member</span>
                    @endif
                </small>
            </div>

            <div class="form-group">
                <label>Service</label>
                <select name="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $transaksi->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->nama_layanan }} - {{ $service->harga }}/{{ $service->satuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Berat (kg)</label>
                <input type="number" name="berat" value="{{ $transaksi->berat }}" class="form-control" step="0.1" required>
            </div>

            <div class="form-group">
                <label>Total Harga</label>
                <input type="number" name="total_harga" value="{{ $transaksi->total_harga }}" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Diambil">Diambil</option>
            </select>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    const serviceSelect = document.getElementById('service');
    const beratInput = document.getElementById('berat');
    const totalInput = document.getElementById('total_harga');

    function hitungTotal() {
        const harga = parseFloat(
            serviceSelect.options[serviceSelect.selectedIndex].dataset.harga
        ) || 0;

        const berat = parseFloat(beratInput.value) || 0;
        totalInput.value = Math.round(harga * berat);
    }

    serviceSelect.addEventListener('change', hitungTotal);
    beratInput.addEventListener('input', hitungTotal);

    // Hitung otomatis saat halaman edit dibuka
    document.addEventListener('DOMContentLoaded', hitungTotal);
</script>
@stop