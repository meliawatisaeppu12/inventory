@extends('staff.layout.main')
@section('staff.content')

<div class="col-xl-12">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <article class="statistic-box green">
                    <div>
                        <div class="number">{{ $totalBarang }}</div>
                        <div class="caption">
                            <div>Jumlah Barang</div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-sm-3">
                <article class="statistic-box red">
                    <div>
                        <div class="number">{{ $totalStokBarang }}</div>
                        <div class="caption">
                            <div>Jumlah Barang Tersedia</div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-sm-3">
                <article class="statistic-box yellow">
                    <div>
                        <div class="number">{{ $totalPeminjaman }}</div>
                        <div class="caption">
                            <div>Total Peminjaman Anda</div>
                        </div>
                    </div>
                </article>
            </div>


        </div>
    </div>
    @endsection