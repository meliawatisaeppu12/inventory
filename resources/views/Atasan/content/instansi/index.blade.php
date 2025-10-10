@extends('Atasan/layout/main')
@section('Atasan/content')

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
        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">

            @csrf
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>

                </tr>
            </thead>
            <tbody>
                @forelse($instansi as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->nama_instansi}}</td>
                    <td>{{$row->alamat}}</td>

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