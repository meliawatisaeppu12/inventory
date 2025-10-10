@extends('Admin/layout/main')
@section('Admin/content')

<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">UBAH DATA PEMINJAMAN</h4>
    </div>

    <div class="card-body">
        <form action="{{route ('admin.peminjaman.update', $peminjaman->id_peminjaman)}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class=" row mb-3">
                <label for="detail_kegiatan" class="col-sm-2 col-form-label">Detail Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('detail_kegiatan') is-invalid @enderror" name="detail_kegiatan" value="{{ $peminjaman->detail_kegiatan }}">
                    @error('detail_kegiatan')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="tgl_peminjaman" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control @error('tgl_peminjaman') is-invalid @enderror" name="tgl_peminjaman" value="{{ $peminjaman->tgl_peminjaman }}" id="tgl_peminjaman">
                    @error('tgl_peminjaman')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="batas_peminjaman" class="col-sm-2 col-form-label">Batas Peminjaman</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control @error('batas_peminjaman') is-invalid @enderror" name="batas_peminjaman" value="{{ $peminjaman->batas_peminjaman }}" id="batas_peminjaman">
                    @error('batas_peminjaman')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Peminjam otomatis dari user yang login --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Peminjam</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ auth()->guard('admin')->user()->nama_pengguna }}">
                    <input type="hidden" name="id_pengguna" value="{{ auth()->guard('admin')->user()->id_pengguna }}">
                </div>
            </div>


            <div class="row mb-3">
                <label for="id_barang" class="col-sm-2 col-form-label">Barang</label>
                <div class="col-sm-10">
                    <select name="id_barang" id="id_barang" class="form-control">
                        @foreach($barang as $item)
                        @php
                        $select = "";
                        if($item->id_barang == $peminjaman->id_barang){
                        $select = "selected";
                        }
                        @endphp
                        <option value="{{$item->id_barang}}" <?= $select ?>>{{$item->nama_barang}}</option>
                        @endforeach
                    </select>
                    @error('id_barang')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah_pinjam" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('jumlah_pinjam') is-invalid @enderror" min="1" name="jumlah_pinjam" value="{{ $peminjaman->jumlah_pinjam }}" id="jumlah_pinjam">
                    <small id="stok_warning" class="text-danger d-none">Jumlah pinjam melebihi stok!</small>
                    @error('jumlah_pinjam')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <input type="submit" value="Submit" class="btn btn-success">
                <a href="{{route ('admin.peminjaman.index')}}" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    //batas minim tanggal
    $(function() {
        $('[type="datetime-local"]').prop('min', function() {
            return new Date().toJSON().split('T')[0];
        });
    });
</script>
@endsection