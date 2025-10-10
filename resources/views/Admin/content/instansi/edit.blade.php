@extends('Admin/layout/main')
@section('Admin/content')


<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">UBAH DATA INSTANSI</h4>
    </div>
    <div class="card-body">
        <form action="{{route('admin.instansi.update', $instansi->id_instansi )}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="nama_instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-10">
                    <input name="nama_instansi" type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$instansi->nama_instansi}}">
                </div>
            </div>
            @error('nama_instansi')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$instansi->alamat}}">
                </div>
            </div>
            @error('alamat')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="text-right">
                <input class="btn btn-success" type="submit" name="submit" value="Submit">
                <a href="{{ route('admin.instansi.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection