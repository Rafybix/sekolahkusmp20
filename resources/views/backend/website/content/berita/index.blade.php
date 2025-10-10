@extends('layouts.backend.app')

@section('title')
    Berita
@endsection

@section('content')

    {{-- 🔹 Alert sukses / error --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body d-flex justify-content-between align-items-center">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-body d-flex justify-content-between align-items-center">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @endif

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Berita</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        {{-- ✅ Cek dulu apakah variabel kategori dikirim --}}
                        @if (isset($kategori) && $kategori->count() > 0)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">Daftar Berita</h4>
                                        <a href="{{ route('backend-berita.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i> Tambah
                                        </a>
                                    </div>

                                    <div class="card-datatable">
                                        <table class="dt-responsive table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Title</th>
                                                    <th>Thumbnail</th>
                                                    <th>Kategori</th>
                                                    <th>Status</th>
                                                    <th width="150px">Action</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @forelse ($berita as $key => $beritas)
                                                    <tr class="text-center align-middle">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $beritas->title }}</td>
                                                        <td>
                                                            @if ($beritas->thumbnail && file_exists(storage_path('app/public/images/berita/' . $beritas->thumbnail)))
                                                                <img src="{{ asset('storage/images/berita/' . $beritas->thumbnail) }}" 
                                                                     alt="thumbnail" 
                                                                     class="img-thumbnail" 
                                                                     style="max-width: 60px; max-height: 60px;">
                                                            @else
                                                                <span class="text-muted">Tidak ada</span>
                                                            @endif
                                                        </td>

                                                        {{-- ✅ Aman dari error null --}}
                                                        <td>{{ $beritas->kategori?->nama ?? '-' }}</td>

                                                        <td>
                                                            @if ($beritas->is_active == '0')
                                                                <span class="badge badge-success">Publish</span>
                                                            @else
                                                                <span class="badge badge-secondary">Draft</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">
                                                            <a href="{{ route('backend-berita.edit', $beritas->id) }}" 
                                                               class="btn btn-success btn-sm">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>

                                                            <form action="{{ route('backend-berita.destroy', $beritas->id) }}" 
                                                                  method="POST" 
                                                                  style="display:inline-block;" 
                                                                  onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">
                                                            Belum ada berita yang ditambahkan.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>                                   
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 text-center mt-4">
                                <h5 class="text-muted">Kategori masih kosong!</h5>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
