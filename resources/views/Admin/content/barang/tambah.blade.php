@extends('Admin/layout/main')
@section('Admin/content')

<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">TAMBAH DATA BARANG</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.barang.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                    <input type="text" name="kode_barang" class="form-control" id="nidn" placeholder="KODE BARANG" required>
                    @error('kode_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="kode_lokasi" class="col-sm-2 col-form-label">Kode Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" name="kode_lokasi" class="form-control" id="kode_lokasi" placeholder="KODE LOKASI" required>
                    @error('kode_lokasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="NAMA BARANG" required>
                    @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nomor_registrasi" class="col-sm-2 col-form-label">Nomor Registrasi</label>
                <div class="col-sm-10">
                    <input type="text" name="nomor_registrasi" class="form-control" id="nomor_registrasi" placeholder="NOMOR REGISTRASI">
                    @error('nomor_regitrasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                <div class="col-sm-10">
                    <input type="number" name="jumlah_barang" class="form-control" id="jumlah_barang" placeholder="Jumlah barang">
                    @error('jumlah_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="jumlah_tersedia" class="col-sm-2 col-form-label">Jumlah Tersedia</label>
                <div class="col-sm-10">
                    <input type="number" name="jumlah_tersedia" class="form-control" id="jumlah_tersedia" placeholder="Jumlah Tersedia">
                    @error('jumlah_tersedia')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <input type="Submit" class="btn btn-success" value="Submit">
                <a href="{{route('admin.barang.index')}}" type="button" class="btn btn-danger">Batal</a>
            </div>
    </div>
    </form>
</div>


@endsection