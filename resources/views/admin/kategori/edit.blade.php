@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Edit Kategori</h2>

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" class="form-control" required>
            @error('nama')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
