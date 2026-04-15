@extends('backend.v_layouts.app')
@section('content')

<div class="row align-items-center mb-4">
    <div class="col">
        <h3 class="fw-bold m-0" style="color: #001437;">Manajemen Pengguna</h3>
        <p class="text-muted m-0">Daftar seluruh akun Admin dan Pelanggan Suzuki Ratan</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0 align-middle table-hover">

                <!-- HEADER -->
                <thead style="background: #f8f9fa;">
                    <tr style="font-size: 13px; color: #8a98ac; text-transform: uppercase;">
                        <th class="ps-4 py-3 border-0">Profil</th>
                        <th class="border-0">Kontak</th>
                        <th class="border-0">Role</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @forelse ($users as $row)
                    <tr>

                        <!-- PROFIL -->
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light text-primary d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                     style="width: 40px; height: 40px;">
                                    {{ strtoupper(substr($row->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <span class="fw-bold">{{ $row->nama }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- KONTAK -->
                        <td>
                            <div>{{ $row->email }}</div>
                            <small class="text-muted">{{ $row->no_hp ?? '-' }}</small>
                        </td>

                        <!-- ROLE -->
                        <td>
                            @if($row->role == 1)
                                <span class="badge bg-danger rounded-pill">Super Admin</span>
                            @elseif($row->role == 0)
                                <span class="badge bg-primary rounded-pill">Admin</span>
                            @else
                                <span class="badge bg-success rounded-pill">Pelanggan</span>
                            @endif
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            {{ $row->created_at->format('d M Y') }}
                        </td>

                        <!-- AKSI -->
                        <td class="text-center position-relative">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow"
                                    style="border-radius: 10px; z-index: 9999;">

                                    <!-- EDIT -->
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('backend.user.edit', $row->id) }}">
                                            <i class="bi bi-pencil me-2"></i> Edit
                                        </a>
                                    </li>

                                    <!-- HAPUS -->
                                    <li>
                                        <form action="{{ route('backend.user.destroy', $row->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i> Hapus
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection