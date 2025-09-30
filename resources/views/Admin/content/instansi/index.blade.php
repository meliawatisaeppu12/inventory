@extends('admin/layout/main')
@section('admin.content')

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
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">DAFTAR INSTANSI</h4>
    </div>
    <div class="card-block">
        <a href="{{route('admin.instansi.tambah')}}" class="ml-lg-3 mb-3 btn btn-default"><i class="fa fa-plus-circle"></i> Tambah</a>
        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">

            @csrf
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instansi as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->nama_instansi}}</td>
                    <td>{{$row->alamat}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.instansi.edit',$row->id_instansi)}}" data-toogle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil-square-o" style="color: #ffc107;"></i>
                        </a>|
                        <a href="{{ route('admin.instansi.hapus', $row->id_instansi) }}" onclick="return confirm('anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash-o" style="color: #dc3545;"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center fs-5" colspan="11">
                        <h6 style="color:#d5d5d5; margin-top:3px;"><b> Data Instansi Kosong, Silahkan
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