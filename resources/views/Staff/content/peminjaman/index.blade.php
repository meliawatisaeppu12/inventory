@extends('staff.layout.main')
@section('staff.content')

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
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 15px">DAFTAR PEMINJAMAN</h4>
    </div>
    <div class="card-block">
        <a href="{{route('staff.peminjaman.tambah')}}" class="ml-lg-3 mb-3 btn btn-default"><i class="fa fa-plus-circle"></i> Tambah</a>
        <a class="btn btn-success tb-detail mb-3" href="{{route('staff.peminjaman.excel')}}"><i class="fa fa-file-pdf-o"></i> Excel
        </a>
        <a class="btn btn-danger tb-detail mb-3" href="{{route('staff.peminjaman.pdf')}}"><i class="fa fa-file-pdf-o"></i> PDF
        </a>
        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">

            @csrf
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Peminjam</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Pinjam</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjaman as $row)
                <tr>
                    <td class="text-center"><b>{{$loop->iteration}}</b></td>
                    <td>{{ $row->detail_kegiatan }}</td>
                    <td>{{ $row->pengguna }}</td>
                    <td>{{ $row->barang }}</td>
                    <td>{{ $row->jumlah_pinjam}}</td>
                    <td>{{ $row->tgl_peminjaman}}</td>
                    <td>{{ $row->batas_peminjaman }}</td>


                    <td>
                        @if($row->keterangan === 'ditolak')
                        <span class="badge bg-danger">Ditolak</span><br>
                        @elseif($row->keterangan === 'pengajuan')
                        <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                        @elseif($row->keterangan === 'dipinjam')
                        <span class="badge bg-success">Dipinjam</span>
                        @elseif($row->keterangan === 'dikembalikan')
                        <span class="badge bg-primary">Dikembalikan</span>
                        @elseif($row->keterangan === 'terlambat')
                        <span class="badge bg-danger">Terlambat</span>
                        @endif
                    </td>


                    <td>
                        @if($row->keterangan === 'ditolak')
                        <small class="text">Alasan: {{ $row->alasan_penolakan ?? '-' }}</small>
                        @else
                        <small class="text-muted">-</small>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('staff.peminjaman.edit', $row->id_peminjaman) }}">
                            <i class="fa fa-pencil-square-o" style="color: #ffc107;"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center fs-5" colspan="11">
                        <h6 style="color:#d5d5d5; margin-top:3px;"><b> Data Peminjaman Kosong, Silahkan Mengajukan Peminjaman</b></h6>
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