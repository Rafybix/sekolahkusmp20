@extends('layouts.backend.app')

@section('title')
   Footer
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <h2>Footer Sekolah</h2>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header header-bottom">
                        <h4>Kelola Footer</h4>
                    </div>

                    {{-- Jika footer masih kosong tampilkan form tambah --}}
                    @if ($footer == NULL)
                        <div class="card-body">
                            <form action="{{ route('backend-footer.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Telepon</label> <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required>
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label> <span class="text-danger">*</span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat Sekolah</label> <span class="text-danger">*</span>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('backend-footer.index') }}" class="btn btn-warning">Batal</a>
                            </form>
                        </div>

                    {{-- Jika sudah ada data footer tampilkan form edit --}}
                    @else
                        <div class="card-body">
                            <form action="{{ route('backend-footer.update', $footer->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Telepon</label> <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp', $footer->telp) }}" required>
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label> <span class="text-danger">*</span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $footer->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat Sekolah</label> <span class="text-danger">*</span>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $footer->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('backend-footer.index') }}" class="btn btn-warning">Batal</a>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
