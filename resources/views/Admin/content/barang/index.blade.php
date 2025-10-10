@extends('Admin/layout/main')
@section('Admin/content')

@if ($message = Session::get('success'))
<div class="custom-alert alert-success" id="alertBox">
    <span class="alert-message">{{ $message }}</span>
    <button type="button" class="alert-close" data-dismiss="alert">&times;</button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="custom-alert alert-danger" id="alertBox">
    <span class="alert-message">{{ $message }}</span>
    <button type="button" class="alert-close" data-dismiss="alert">&times;</button>
</div>
@endif


<section class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">DAFTAR BARANG</h4>
    </div>
    <div class="card-block table-responsive">
        <a href="{{route('admin.barang.tambah')}}" class="ml-lg-3 mb-3 btn btn-default"><i class="fa fa-plus-circle"></i> Tambah</a>
        <a class="btn btn-success tb-detail mb-3" href="{{route('admin.barang.excel')}}"><i class="fa fa-file-pdf-o"></i> Excel
        </a>
        <a class="btn btn-danger tb-detail mb-3" href="{{route('admin.barang.pdf')}}"><i class="fa fa-file-pdf-o"></i> PDF
        </a>
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
                    <th>Aksi</th>
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
                    <td class="text-center">
                        <a href="{{ route('admin.barang.edit', $row->id_barang) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="{{ route('admin.barang.hapus', $row->id_barang) }}"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>

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