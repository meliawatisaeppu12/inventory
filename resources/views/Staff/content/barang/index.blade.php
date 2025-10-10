@extends('Staff/layout/main')
@section('Staff/content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<section class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 15px">DAFTAR BARANG</h4>
    </div>
    <div class="card-block table-responsive">

        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">

            @csrf
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Kode Lokasi</th>
                    <th>Nama Barang</th>
                    <th>Nomor Registrasi</th>
                    <th>Jumlah Barang</th>
                    <th>Jumlah Tersedia</th>

                </tr>
            </thead>

            <tbody>
                @forelse($barang as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->kode_barang}}</td>
                    <td>{{$row->kode_lokasi}}</td>
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->nomor_registrasi}}</td>
                    <td>{{$row->jumlah_barang}}</td>
                    <td>{{$row->jumlah_tersedia}}</td>

                </tr>

                @empty
                <tr>
                    <td class="text-center fs-5" colspan="11">
                        <h6 style="color:#d5d5d5; margin-top:3px;"><b> Data Barang Kosong, Silahkan
                                Ditambahkan!</b></h6>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</section>
<script>
    $(function() {
        $('#example').DataTable();
    });
</script>
@endsection