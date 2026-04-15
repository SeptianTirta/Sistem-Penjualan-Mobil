@extends('backend.v_layouts.app')
@section('content')

<div class="row align-items-center mb-4">
    <div class="col">
        <h3 class="fw-bold m-0" style="color: #001437;">Kategori Tipe</h3>
        <p class="text-muted m-0">Kelola klasifikasi armada Suzuki</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('backend.tipe.create') }}" 
           class="btn px-4 py-2 shadow-sm"
           style="background:#EA5555; color:white; border-radius:10px;">
            <i class="bi bi-plus-lg me-2"></i>Tambah
        </a>
    </div>
</div>

{{-- ALERT --}}
@if (session('success'))
    <div class="alert alert-success small shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table mb-0 align-middle table-hover">

                <!-- HEADER -->
                <thead style="background: #f8f9fa;">
                    <tr style="font-size: 13px; color:#8a98ac; text-transform:uppercase;">
                        <th class="ps-4 py-3 border-0">ID</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0">Deskripsi</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @forelse ($index as $row)
                    <tr>

                        <!-- ID -->
                        <td class="ps-4 text-muted">
                            #{{ $row->id }}
                        </td>

                        <!-- NAMA -->
                        <td>
                            <span class="fw-bold">
                                {{ $row->nama_tipe }}
                            </span>
                        </td>

                        <!-- DESKRIPSI -->
                        <td class="text-muted" style="max-width: 350px;">
                            {{ \Illuminate\Support\Str::limit($row->deskripsi ?? '-', 80) }}
                        </td>

                        <!-- AKSI -->
                        <td class="text-center position-relative">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0"
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow"
                                    style="border-radius:10px; z-index:9999;">

                                    <!-- EDIT -->
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('backend.tipe.edit', $row->id) }}">
                                            <i class="bi bi-pencil me-2"></i> Edit
                                        </a>
                                    </li>

                                    <!-- HAPUS -->
                                    <li>
                                        <form action="{{ route('backend.tipe.destroy', $row->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus kategori ini?')">
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
                        <td colspan="4" class="text-center py-5 text-muted">
                            Belum ada kategori tipe.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection