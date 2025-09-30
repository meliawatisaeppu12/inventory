@extends('admin.layout.main')
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
        <h4 class="text-center font-weight-bold text-white" style="margin-top: 20px">DAFTAR PEMINJAMAN</h4>
    </div>
    <div class="card-block">
        <a href="{{route('admin.peminjaman.tambah')}}" class="ml-lg-3 mb-3 btn btn-default"><i class="fa fa-plus-circle"></i> Tambah</a>
        <a class="btn btn-success tb-detail mb-3" href="{{route('admin.peminjaman.excel')}}"><i class="fa fa-file-pdf-o"></i> Excel
        </a>
        <a class="btn btn-danger tb-detail mb-3" href="{{route('admin.peminjaman.pdf')}}"><i class="fa fa-file-pdf-o"></i> PDF
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
                    <th>Keterangan</th>
                    <th>Tindak</th>
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
                        <span class="badge bg-warning">Terlambat</span>
                        @endif
                    </td>


                    <td>
                        {{-- Tombol Kembalikan hanya muncul jika dipinjam atau terlambat --}}
                        @if(in_array($row->keterangan, ['dipinjam', 'terlambat']))
                        <form action="{{ route('admin.peminjaman.kembalikan', $row->id_peminjaman) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin barang sudah dikembalikan?')"
                            class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary">Kembalikan</button>
                        </form>
                        @endif

                        <br>

                        {{-- Alasan penolakan hanya tampil kalau status ditolak --}}
                        @if($row->keterangan === 'ditolak')
                        <small class="text">Alasan: {{ $row->alasan_penolakan ?? '-' }}</small>
                        @endif
                    </td>

                    <td>
                        @if($row->keterangan === 'pengajuan')
                        <!-- Tombol Setujui -->
                        <form action="{{ route('admin.peminjaman.setuju', $row->id_peminjaman) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                        </form>

                        <!-- Tombol Tolak (buka modal) -->
                        <button type="button"
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTolak{{ $row->id_peminjaman }}">
                            Tolak
                        </button>

                        <!-- Modal Tolak -->
                        <div class="modal fade"
                            id="modalTolak{{ $row->id_peminjaman }}"
                            tabindex="-1"
                            aria-labelledby="modalTolakLabel{{ $row->id_peminjaman }}"
                            aria-hidden="true">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.peminjaman.tolak', $row->id_peminjaman) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTolakLabel{{ $row->id_peminjaman }}">
                                                Tolak Peminjaman
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="alasan_penolakan{{ $row->id_peminjaman }}" class="form-label">
                                                    Alasan Penolakan
                                                </label>
                                                <textarea
                                                    name="alasan_penolakan"
                                                    id="alasan_penolakan{{ $row->id_peminjaman }}"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Tuliskan alasan penolakan..."
                                                    required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @endif
                    </td>



                    <td class="text-center">
                        <a href="{{ route('admin.peminjaman.edit', $row->id_peminjaman) }}">
                            <i class="fa fa-pencil-square-o" style="color: #ffc107;"></i>
                        </a>
                        |
                        <a href="{{ route('admin.peminjaman.hapus', $row->id_peminjaman) }}" onclick="return confirm('anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash-o" style="color: #dc3545;"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center fs-5" colspan="11">
                        <h6 style="color:#d5d5d5; margin-top:3px;"><b> Data Peminjaman Kosong, Silahkan
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