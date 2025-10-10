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
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">DAFTAR PENGGUNA</h4>
    </div>
    <div class="card-block table-responsive">
        <a href="{{route('admin.pengguna.tambah')}}" class="ml-lg-3 mb-3 btn btn-default"><i class="fa fa-plus-circle"></i> Tambah</a>
        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">

            @csrf
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Role</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengguna as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->role}}</td>
                    <td>{{$row->nama_pengguna}}</td>
                    <td>{{$row->jk_pengguna}}</td>
                    <td>{{$row->telepon}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->instansi}}</td>

                    <td class="text-center">
                        <a href="{{ route('admin.pengguna.edit', $row->id_pengguna) }}"
                            class="btn btn-warning btn-sm"
                            title="Edit Data">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="{{ route('admin.pengguna.hapus', $row->id_pengguna) }}"
                            class="btn btn-danger btn-sm"
                            title="Hapus Data"
                            onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
                @empty
                <tr>
                    <td class="text-center fs-5" colspan="11">
                        <h6 style="color:#d5d5d5; margin-top:3px;"><b> Data Pengguna Kosong, Silahkan
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