@extends('backend.v_layouts.app')
@section('content')

<div class="mb-4">
    <h3 class="fw-bold" style="color: #001437;">{{ $judul }}</h3>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 18px; border-left: 6px solid #FFC107;">
    <div class="card-body p-4">
        <form action="{{ route('backend.mobil.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 border-end">
                    <div class="mb-3">
                        <label class="fw-bold text-muted mb-2">Tipe Mobil</label>
                        <select name="tipe_id" class="form-select">
                            @foreach ($tipe as $t)
                                <option value="{{ $t->id }}" {{ $edit->tipe_id == $t->id ? 'selected' : '' }}>{{ $t->nama_tipe }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted mb-2">Nama Mobil</label>
                        <input type="text" name="nama_mobil" value="{{ $edit->nama_mobil }}" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="fw-bold text-muted mb-2">Tahun</label>
                            <input type="number" name="tahun" value="{{ $edit->tahun }}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="fw-bold text-muted mb-2">Warna</label>
                            <input type="text" name="warna" value="{{ $edit->warna }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 ps-md-4">
                    <div class="mb-3">
                        <label class="fw-bold text-muted mb-2">Harga Jual (Rp)</label>
                        <input type="number" name="harga" value="{{ $edit->harga }}" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="fw-bold text-muted mb-2">Stok Unit</label>
                            <input type="number" name="stok" value="{{ $edit->stok }}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="fw-bold text-muted mb-2">Kapasitas</label>
                            <input type="number" name="kapasitas" value="{{ $edit->kapasitas }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted mb-2">Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/img_mobil/'.$edit->gambar_mobil) }}" class="rounded shadow-sm mb-2" style="width: 150px;">
                        <input type="file" name="gambar_mobil" class="form-control">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.mobil.index') }}" class="btn btn-light px-4 me-2 fw-bold">Batal</a>
                <button type="submit" class="btn px-5 shadow-sm" style="background: #FFC107; color: #001437; font-weight: bold;">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

@endsection