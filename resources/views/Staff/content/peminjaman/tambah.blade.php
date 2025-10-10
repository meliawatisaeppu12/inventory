@extends('Staff/layout/main')
@section('Staff/content')

{{-- Notifikasi --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">
            TAMBAH DATA PEMINJAMAN
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('staff.peminjaman.store') }}" method="post">
            @csrf

            {{-- Peminjam otomatis dari user login --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Peminjam</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"
                        value="{{ auth()->guard('staff')->user()->nama_pengguna }}" readonly>
                    <input type="hidden" name="id_pengguna"
                        value="{{ auth()->guard('staff')->user()->id_pengguna }}">
                </div>
            </div>

            {{-- Pilih Barang --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select name="id_barang" id="id_barang" class="form-control" required>
                        <option disabled selected> - Pilih Barang -</option>
                        @foreach($barang as $item)
                        <option value="{{ $item->id_barang }}" data-stok="{{ $item->jumlah_tersedia }}">
                            {{ $item->nama_barang }} (stok: {{ $item->jumlah_tersedia }})
                        </option>
                        @endforeach
                    </select>
                    @error('id_barang')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Jumlah Pinjam --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" id="jumlah_pinjam" name="jumlah_pinjam" class="form-control" min="1" required>
                    <small id="stok_warning" class="text-danger d-none">Jumlah pinjam melebihi stok!</small>
                    @error('jumlah_pinjam')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Detail Kegiatan --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Detail Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('detail_kegiatan') is-invalid @enderror"
                        name="detail_kegiatan" value="{{ old('detail_kegiatan') }}" placeholder="Detail Kegiatan">
                    @error('detail_kegiatan')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tanggal Pinjam --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control @error('tgl_peminjaman') is-invalid @enderror"
                        name="tgl_peminjaman" value="{{ old('tgl_peminjaman') }}">
                    @error('tgl_peminjaman')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Batas Pinjam --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Batas Peminjaman</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control @error('batas_peminjaman') is-invalid @enderror"
                        name="batas_peminjaman" value="{{ old('batas_peminjaman') }}">
                    @error('batas_peminjaman')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <input type="submit" class="btn btn-success" value="Submit" id="submitBtn">
                <a href="{{ route('staff.peminjaman.index') }}" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- Script Validasi Stok --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectBarang = document.getElementById("id_barang");
        const inputJumlah = document.getElementById("jumlah_pinjam");
        const warning = document.getElementById("stok_warning");
        const submitBtn = document.querySelector("form button[type='submit']");

        function validateJumlah() {
            let selectedOption = selectBarang.options[selectBarang.selectedIndex];
            let stok = selectedOption ? parseInt(selectedOption.getAttribute("data-stok")) || 0 : 0;
            let jumlah = parseInt(inputJumlah.value) || 0;

            if (jumlah > stok) {
                warning.classList.remove("d-none");
                submitBtn.disabled = true;
            } else {
                warning.classList.add("d-none");
                submitBtn.disabled = false;
            }
        }

        selectBarang.addEventListener("change", validateJumlah);
        inputJumlah.addEventListener("input", validateJumlah);
    });
</script>

@endsection