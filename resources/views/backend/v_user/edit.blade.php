@extends('backend.v_layouts.app')
@section('content')

<div class="row mb-4">
    <div class="col">
        <h3 class="fw-bold m-0" style="color: #001437;">Ubah Data Pengguna</h3>
        <p class="text-muted m-0">Sesuaikan profil atau ubah hak akses pengguna</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('backend.user.update', $edit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small text-muted text-uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $edit->nama) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small text-muted text-uppercase mb-2">Email Aktif</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $edit->email) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small text-muted text-uppercase mb-2">Nomor HP / WhatsApp</label>
                    <input type="number" name="no_hp" class="form-control" value="{{ old('no_hp', $edit->no_hp) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small text-muted text-uppercase mb-2">Hak Akses (Role)</label>
                    <select name="role" class="form-select" required>
                        <option value="2" {{ $edit->role == 2 ? 'selected' : '' }}>Pelanggan</option>
                        <option value="0" {{ $edit->role == 0 ? 'selected' : '' }}>Admin Dealer</option>
                        <option value="1" {{ $edit->role == 1 ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-bold small text-muted text-uppercase mb-2">Kata Sandi Baru <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                <small class="text-muted">Biarkan kosong jika password pelanggan tetap sama.</small>
            </div>

            <hr class="opacity-25 my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('backend.user.index') }}" class="btn btn-light border px-4 shadow-sm">Batal</a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection