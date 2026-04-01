@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
    <h1>✨ Tambah Transaksi Laundry</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            {{-- CUSTOMER LAMA --}}
            <div class="form-group">
                <label>Pilih Customer Lama</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    <option value="">-- Customer Baru --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->nama_pelanggan }} - {{ $c->nomor_telepon }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>

            {{-- CUSTOMER BARU --}}
            <div id="customer-baru">
                <h5>➕ Customer Baru</h5>

                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" name="nama_pelanggan" class="form-control">
                </div>

                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_member" value="1">
                        Jadikan Member
                    </label>
                </div>
            </div>

            <hr>

            {{-- SERVICE --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Service</label>
                    <select name="service_id" id="service" class="form-control" required>
                        <option value="">-- Pilih Service --</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" data-harga="{{ $s->harga_per_kg }}">
                                {{ $s->nama_layanan }} - Rp {{ number_format($s->harga_per_kg) }}/kg
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <label>Berat (kg)</label>
                    <input type="number" name="berat" id="berat" class="form-control" step="0.1" required>
                </div>
            </div>

            {{-- TOTAL --}}
            <div class="form-group">
                <label>Total Harga</label>
                <input type="number" id="total_harga" class="form-control" readonly>
            </div>

            {{-- TANGGAL + STATUS --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                        value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-6 form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Diambil">Diambil</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                💾 Simpan Transaksi
            </button>

        </form>

    </div>
</div>

@stop

@section('js')
<script>
    const customerId = document.getElementById('customer_id');
    const customerBaru = document.getElementById('customer-baru');

    const service = document.getElementById('service');
    const berat = document.getElementById('berat');
    const total = document.getElementById('total_harga');

    // ================= TOTAL HITUNG =================
    function hitungTotal() {
        let harga = service.options[service.selectedIndex]?.dataset.harga || 0;
        let kg = berat.value || 0;

        total.value = harga * kg;
    }

    service.addEventListener('change', hitungTotal);
    berat.addEventListener('input', hitungTotal);

    // ================= TOGGLE CUSTOMER =================
    function toggleCustomer() {
        let pilihLama = customerId.value !== "";

        customerBaru.style.display = pilihLama ? "none" : "block";

        document.querySelector('[name="nama_pelanggan"]').disabled = pilihLama;
        document.querySelector('[name="nomor_telepon"]').disabled = pilihLama;
        document.querySelector('[name="alamat"]').disabled = pilihLama;
    }

    customerId.addEventListener('change', toggleCustomer);
    toggleCustomer();
</script>
@stop