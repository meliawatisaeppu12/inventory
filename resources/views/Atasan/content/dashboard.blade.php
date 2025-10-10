@extends('Atasan/layout/main')
@section('Atasan/content')

<style>
    .statistic-box {
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-align: center;
    }

    .statistic-box:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .statistic-box .number {
        font-size: 28px;
        font-weight: bold;
    }

    .statistic-box .caption div {
        font-size: 15px;
    }

    /* Warna tambahan agar konsisten */
    .statistic-box.green {
        background-color: #4CAF50;
        color: white;
    }

    .statistic-box.red {
        background-color: #F44336;
        color: white;
    }

    .statistic-box.purple {
        background-color: #9C27B0;
        color: white;
    }

    .statistic-box.yellow {
        background-color: #FFC107;
        color: white;
    }

    a.stat-link {
        text-decoration: none;
        color: inherit;
    }

    .statistic-box:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>

<div class="col-xl-12">
    <div class="row">

        <!-- Jumlah Barang -->
        <div class="col-sm-3">
            <a href="{{ route('admin.barang.index') }}" class="stat-link">
                <article class="statistic-box green">
                    <div>
                        <div class="number">{{ $totalBarang }}</div>
                        <div class="caption">
                            <div>Jumlah Barang</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <!-- Jumlah Barang Tersedia -->
        <div class="col-sm-3">
            <a href="{{ route('admin.barang.index') }}" class="stat-link">
                <article class="statistic-box red">
                    <div>
                        <div class="number">{{ $totalStokBarang }}</div>
                        <div class="caption">
                            <div>Jumlah Barang Tersedia</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <!-- Total Instansi -->
        <div class="col-sm-3">
            <a href="{{ route('admin.instansi.index') }}" class="stat-link">
                <article class="statistic-box purple">
                    <div>
                        <div class="number">{{ $totalInstansi }}</div>
                        <div class="caption">
                            <div>Total Instansi</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

        <!-- Total Peminjaman -->
        <div class="col-sm-3">
            <a href="{{ route('admin.peminjaman.index') }}" class="stat-link">
                <article class="statistic-box yellow">
                    <div>
                        <div class="number">{{ $totalPeminjaman }}</div>
                        <div class="caption">
                            <div>Total Peminjaman</div>
                        </div>
                    </div>
                </article>
            </a>
        </div>

    </div>
</div>

@endsection