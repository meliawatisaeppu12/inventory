@extends('admin/layout/main')
@section('admin.content')


<div class="card">
    <div class="card-header-lg" style="background-color: #2c313e">
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">TAMBAH PENGGUNA</h4>
    </div>

    <div class="card-body">
        <form action="{{route ('admin.pengguna.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <label for="role">
                            <input type="radio" name="role" value="admin" id="role" checked> Admin
                            <input type="radio" name="role" value="staff" id="role" checked> Staff
                            <input type="radio" name="role" value="atasan" id="role" checked> Atasan
                        </label>
                        
                    </div>
                </div>
            </div>
            @error('role')
            <div class="error">{{ $message }}</div>
            @enderror

            
            <div class="row mb-3">
                <label for="nama_pengguna" class="col-sm-2 col-form-label">Nama Pengguna</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" placeholder="Nama Pengguna" required>
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
                    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" placeholder="Telepon" required>
                </div>
            </div>
            @error('telepon')
                <div class="error">{{ $message }}</div>
            @enderror
               

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email " required>
                </div>
            </div>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password " required>
                </div>
            </div>
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror

            <div class="row mb-3">
                <label for="date_start" class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-10">
                    <select name="id_instansi" id="id_instansi" class="form-control">
                        <option disabled selected> - Pilih Instansi -</option>
                        @foreach($instansi as $item)
                            <option value="{{ $item->id_instansi }}">{{ $item->nama_instansi}}</option>
                        @endforeach
                    </select>
                    @error('id_instansi')
                    <div class="form-tooltip-error sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <input type="Submit" class="btn btn-success" value="Submit">
                <a href="{{route('admin.pengguna.index')}}" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>

</div>


@endsection
