@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="modern-title">✨ Dashboard LaundryBBW</h1>
@stop

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #1e293b, #020617); /* lebih gelap & soft */
        color: #111827; /* HITAM */
    }

    .modern-title {
        font-weight: bold;
        color: #111827; /* ubah jadi hitam */
        background: none;
        -webkit-text-fill-color: unset;
    }

    .glass-card {
        backdrop-filter: blur(10px);
        background: rgba(255,255,255,0.85); /* lebih terang biar teks hitam jelas */
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: 0.3s;
        color: #111827; /* teks hitam */
    }

    .glass-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .blue { background: #3b82f6; }
    .green { background: #22c55e; }
    .purple { background: #8b5cf6; }
    .red { background: #ef4444; }

    .stat-title {
        font-size: 13px;
        color: #6b7280; /* abu gelap */
        opacity: 1;
    }

    .stat-value {
        font-size: 26px;
        font-weight: bold;
        color: #111827; /* hitam */
    }

    .table-modern {
        background: rgba(255,255,255,0.9);
        border-radius: 15px;
        overflow: hidden;
        color: #111827;
    }

    .table-modern th {
        background: rgba(0,0,0,0.05);
        color: #374151;
        border: none;
    }

    .table-modern td {
        border-top: 1px solid #e5e7eb;
        color: #111827;
    }

    .badge-modern {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        color: white;
    }

    .badge-selesai {
        background: #22c55e;
    }

    .badge-proses {
        background: #f59e0b;
    }
</style>

<div class="row">

    <div class="col-md-3">
        <div class="glass-card d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Customer</div>
                <div class="stat-value">{{ $totalCustomer }}</div>
            </div>
            <div class="icon-box blue">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Service</div>
                <div class="stat-value">{{ $totalService }}</div>
            </div>
            <div class="icon-box green">
                <i class="fas fa-soap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Transaksi</div>
                <div class="stat-value">{{ $totalTransaksi }}</div>
            </div>
            <div class="icon-box purple">
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Pendapatan</div>
                <div class="stat-value">
                    Rp {{ number_format($totalPendapatan,0,',','.') }}
                </div>
            </div>
            <div class="icon-box red">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

</div>

<br>

<div class="glass-card">
    <h5 class="mb-3">📊 Transaksi Terbaru</h5>

    <div class="table-responsive">
        <table class="table table-modern text-white">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Layanan</th>
                    <th>Berat</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiTerbaru as $t)
                <tr>
                    <td>{{ $t->customer->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $t->service->nama_layanan ?? '-' }}</td>
                    <td>{{ $t->berat }} Kg</td>
                    <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                    <td>
                        @if($t->status == 'Selesai')
                            <span class="badge-modern badge-selesai">Selesai</span>
                        @else
                            <span class="badge-modern badge-proses">Proses</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop