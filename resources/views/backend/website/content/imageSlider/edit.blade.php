@extends('layouts.backend.app')

@section('title')
    Edit Kepala Sekolah
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
                    <h2>Edit Kepala Sekolah</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header header-bottom">
                                    <h4>Edit Data Kepala Sekolah</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('backend-kepalasekolah.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Foto Kepala Sekolah</label>
                                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" />
                                                    <span class="text-danger" style="font-size: 10px">Kosongkan jika tidak ingin mengubah.</span>
                                                    @if ($item->foto)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $item->foto) }}" style="max-width: 100px; border-radius: 6px;">
                                                        </div>
                                                    @endif
                                                    @error('foto')
                                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nama Kepala Sekolah</label>
                                                    <input type="text" name="nama" value="{{ $item->nama }}" class="form-control @error('nama') is-invalid @enderror">
                                                    @error('nama')
                                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input type="text" name="nip" value="{{ $item->nip }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label>Sambutan Kepala Sekolah</label>
                                                    <textarea name="sambutan" class="form-control @error('sambutan') is-invalid @enderror" rows="5">{{ $item->sambutan }}</textarea>
                                                    @error('sambutan')
                                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <hr class="my-2">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Instagram</label>
                                                    <input type="url" name="instagram" value="{{ $item->instagram }}" class="form-control" placeholder="https://instagram.com/...">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="url" name="facebook" value="{{ $item->facebook }}" class="form-control" placeholder="https://facebook.com/...">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Youtube</label>
                                                    <input type="url" name="youtube" value="{{ $item->youtube }}" class="form-control" placeholder="https://youtube.com/...">
                                                </div>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary mt-2" type="submit">Update</button>
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
