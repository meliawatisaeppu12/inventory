@extends('admin.layout/main')
@section('admin.content')

<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">UBAH PENGGUNA</h4>
    </div>
    <div class="card-body">
        <form action="{{route('admin.pengguna.update', $pengguna->id_pengguna)}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" >
                        <label for="role">
                            <input type="radio" name="role" value="admin" id="role" checked> Admin
                            <input type="radio" name="role" value="staff" id="role" > Staff
                            <input type="radio" name="role" value="atasan" id="role" > Atasan
                        </label>
                    </div>
                </div>
            </div>
            @error('role')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="nama_pengguna" class="col-sm-2 col-form-label">Pengguna</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_pengguna" class="form-control @error('nama_pengguna') is-invalid @enderror" placeholder="Nama Pengguna" value="{{$pengguna->nama_pengguna}}" required autofocus>
                </div>
            </div>
            @error('nama_pengguna')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="jk_pengguna" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label for="jk_pengguna">
                            <input type="radio" name="jk_pengguna" value="Laki-laki" id="jk_pengguna" checked>Laki-Laki
                            <input type="radio" name="jk_pengguna" value="Perempuan" id="jk_pengguna">Perempuan
                        </label>
                    </div>
                </div>
            </div>
            @error('jk_pengguna')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" placeholder="telepon" value="{{$pengguna->telepon}}" required>
                </div>
            </div>
            @error('telepon')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email " value="{{$pengguna->email}}" required>
                </div>
            </div>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="id_instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-10">
                    <select name="id_instansi" id="id_instansi" class="form-control">
                        @foreach($instansi as $item)
                        @php
                        $select = "";
                        if($item->id_instansi == $pengguna->id_instansi){
                        $select = "selected";
                        }
                        @endphp
                        <option value="{{$item->id_instansi}}" <?= $select ?>>{{$item->nama_instansi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('id_instansi')
                <div class="form-tooltip-error sm">{{ $message }}</div>
            @enderror
               

            <div class="text-right">
                <input type="Submit" class="btn btn-success" value="Submit">
                <a href="{{route('admin.pengguna.index')}}" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>

</div>

@endsection
