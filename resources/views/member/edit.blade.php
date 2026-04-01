@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
    <h1>Edit Member</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('member.update', $member->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_member">Nama Member</label>
                    <input type="text" name="nama_member" class="form-control" id="nama_member" value="{{ $member->nama_member }}" required>
                </div>

                <div class="form-group">
                    <label for="no_telepon">No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="{{ $member->no_telepon }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('member.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop