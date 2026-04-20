@extends('backend.v_layouts.app')
@section('content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h3 class="fw-bold m-0" style="color: #001437; letter-spacing: -0.5px;">Data Pesanan (Booking)</h3>
            <p class="text-muted m-0">Pantau dan kelola pesanan masuk dari pelanggan</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle table-hover">
                    <thead style="background: #f8f9fa;">
                        <tr style="font-size: 13px; color: #8a98ac; text-transform: uppercase; letter-spacing: 1px;">
                            <th class="ps-4 py-3 border-0">Kode/Tanggal</th>
                            <th class="border-0">Pelanggan</th>
                            <th class="border-0">Unit Mobil</th>
                            <th class="border-0 text-center">Status</th>
                            <th class="pe-4 text-center border-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px; color: #001437;">
                        @forelse ($pesanan as $row)
                            <tr style="border-bottom: 1px solid #f1f1f1;">
                                <td class="ps-4">
                                    <span class="fw-bold text-primary">{{ $row->kode_booking }}</span><br>
                                    <small class="text-muted">{{ $row->created_at->format('d M Y') }}</small>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $row->user->nama ?? 'Akun Terhapus' }}</span><br>
                                    <small class="text-muted"><i
                                            class="bi bi-telephone me-1"></i>{{ $row->no_hp }}</small>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $row->mobil->nama_mobil ?? 'Mobil Terhapus' }}</span><br>
                                    <small class="text-danger fw-bold">Rp
                                        {{ number_format($row->booking_fee, 0, ',', '.') }}</small>
                                </td>
                                <td class="text-center">
                                    @if ($row->status == 'Pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                                    @elseif($row->status == 'Diproses')
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">Diproses</span>
                                    @elseif($row->status == 'Selesai')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Batal</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-center">
                                    <form action="{{ route('backend.pesanan.updateStatus', $row->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status"
                                            class="form-select form-select-sm d-inline w-auto bg-light border-0"
                                            onchange="this.form.submit()">
                                            <option value="Pending" {{ $row->status == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Diproses" {{ $row->status == 'Diproses' ? 'selected' : '' }}>
                                                Proses</option>
                                            <option value="Selesai" {{ $row->status == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                            <option value="Batal" {{ $row->status == 'Batal' ? 'selected' : '' }}>Batal
                                            </option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                    <span class="text-muted">Belum ada pesanan masuk.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
