@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Daftar Transaksi</h3>
        <div class="card-tools">
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Transaksi
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Berat</th>
                    <th>Total</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $transaksi->customer->nama_pelanggan ?? '-' }}</td>

                    <td>{{ $transaksi->service->nama_layanan ?? '-' }}</td>

                    <td>{{ $transaksi->berat }} Kg</td>

                    <td>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</td>

                    <td>
                       @if($transaksi->customer && $transaksi->customer->member)
                      <span class="badge badge-success">Member</span>
                       @else
                      <span class="badge badge-secondary">Non Member</span>
                       @endif
                    </td>

                    <td>
                        <span class="badge badge-{{ 
                            $transaksi->status == 'Selesai' ? 'success' : 
                            ($transaksi->status == 'Diambil' ? 'primary' : 'warning') 
                        }}">
                            {{ $transaksi->status }}
                        </span>
                    </td>

                    <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>

                    <td class="d-flex gap-1">

                        <!-- Print -->
                        <a href="{{ route('transaksi.show', $transaksi->id) }}"
                           class="btn btn-info btn-sm" target="_blank">
                            <i class="fas fa-print"></i>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Data tidak ada</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $transaksis->links() }}
    </div>

</div>

@stop