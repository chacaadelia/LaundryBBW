@extends('adminlte::page')

@section('title', 'Detail Member')

@section('content_header')
    <h1>Detail Member</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
                {{-- KOLOM KANAN: DATA --}}
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Member</th>
                            <td>{{ $member->nama_member }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $member->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $member->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('member.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop