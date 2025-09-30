@extends('admin/layout/main')
@section('admin.content')


<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">UBAH DATA BARANG</h4>
    </div>
    <div class="card-body">
        <form action="{{route('admin.barang.update', $barang->id_barang )}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                    <input name="kode_barang" type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$barang->kode_barang}}">
                </div>
            </div>
            @error('kode_barang')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="kode_lokasi" class="col-sm-2 col-form-label">Kode Lokasi</label>
                <div class="col-sm-10">
                    <input name="kode_lokasi" type="text" class="form-control @error('kode_lokasi') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$barang->kode_lokasi}}">
                </div>
            </div>
            @error('kode_lokasi')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input name="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$barang->nama_barang}}">
                </div>
            </div>
            @error('nama_barang')
            <div class="error">{{ $message }}</div>
            @enderror


            <div class="row mb-3">
                <label for="nomor_registrasi" class="col-sm-2 col-form-label">Nomor Registrasi</label>
                <div class="col-sm-10">
                    <input name="nomor_registrasi" type="text" class="form-control @error('nomor_registrasi') is-invalid @enderror" id="formGroupExampleInput" required autofocus value="{{$barang->nomor_registrasi}}">
                </div>
            </div>
            @error('nomor_registrasi')
            <div class="error">{{ $message }}</div>
            @enderror

            
            <div class="row mb-3">
                <label for="jumlah_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                <div class="col-sm-10">
                    <input name="jumlah_barang" type="number" class="form-control @error('jumlah_barang') is-invalid @enderror" id="formGroupExampleInput" autofocus value="{{$barang->jumlah_barang}}">
                </div>
            </div>
            @error('jumlah_barang')
            <div class="error">{{ $message }}</div>
            @enderror

            
            <div class="row mb-3">
                <label for="jumlah_tersedia" class="col-sm-2 col-form-label">Jumlah Tersedia</label>
                <div class="col-sm-10">
                    <input name="jumlah_tersedia" type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror" id="formGroupExampleInput" autofocus value="{{$barang->jumlah_tersedia}}">
                </div>
            </div>
            @error('jumlah_tersedia')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="text-right">
                <input class="btn btn-success" type="submit" name="submit" value="Submit">
                <a href="{{ route('admin.barang.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
