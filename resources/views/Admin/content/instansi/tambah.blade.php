@extends('Admin/layout/main')
@section('Admin/content')


<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">TAMBAH DATA INSTANSI</h4>
    </div>

    <div class="card-body">
        <form action="{{route ('admin.instansi.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="nama_instansi" class="col-sm-2 col-form-label">NAMA INSTANSI</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" placeholder="Nama Instansi" value="{{old('nama_instansi')}}" required autofocus>
                </div>
            </div>
            @error('nama_instansi')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" value="{{old('alamat')}}" required autofocus>
                </div>
            </div>
            @error('alamat')
            <div class="error">{{ $message }}</div>
            @enderror


            <div class="text-right">
                <input type="Submit" class="btn btn-success" value="Submit">
                <a href="{{route('admin.instansi.index')}}" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>

</div>


@endsection