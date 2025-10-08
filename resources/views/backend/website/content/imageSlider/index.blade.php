@extends('layouts.backend.app')


@section('title')
    Kepala Sekolah
@endsection

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-body">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    </div>
@elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-body">
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
                    <h2>Kepala Sekolah</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        {{-- DAFTAR DATA --}}
                        <div class="col-7">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Daftar Kepala Sekolah</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-responsive table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Instagram</th>
                                                <th>Facebook</th>
                                                <th>Youtube</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if ($item->foto)
                                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                                class="img-thumbnail"
                                                                style="max-width: 60px; max-height:60px">
                                                        @else
                                                            <img src="{{ asset('default.jpg') }}" class="img-thumbnail" style="max-width: 60px;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->nip ?? '-' }}</td>
                                                    <td>
                                                        @if($item->instagram)
                                                            <a href="{{ $item->instagram }}" target="_blank"><i class="fab fa-instagram text-danger"></i></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->facebook)
                                                            <a href="{{ $item->facebook }}" target="_blank"><i class="fab fa-facebook text-primary"></i></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->youtube)
                                                            <a href="{{ $item->youtube }}" target="_blank"><i class="fab fa-youtube text-danger"></i></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('backend-kepalasekolah.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                        <form action="{{ route('backend-kepalasekolah.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- FORM TAMBAH --}}
                        <div class="col-5">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4>Tambah Kepala Sekolah</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('backend-kepalasekolah.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
                                            @error('nama')
                                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>NIP</label>
                                            <input type="text" name="nip" class="form-control">
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Foto</label>
                                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                                            @error('foto')
                                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Sambutan</label>
                                            <textarea name="sambutan" rows="4" class="form-control @error('sambutan') is-invalid @enderror"></textarea>
                                            @error('sambutan')
                                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </div>

                                        <hr>

                                        <div class="form-group mb-2">
                                            <label>Instagram</label>
                                            <input type="url" name="instagram" class="form-control" placeholder="https://instagram.com/...">
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Facebook</label>
                                            <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/...">
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Youtube</label>
                                            <input type="url" name="youtube" class="form-control" placeholder="https://youtube.com/...">
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                                        <a href="{{ route('backend-kepalasekolah.index') }}" class="btn btn-warning mt-2">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection
