<?php

namespace App\Export;

use App\Models\peminjaman;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPeminjaman implements FromCollection, WithHeadings, WithMapping, WithStyles
{

    private $no = 0;
    public function collection()
    {
        return peminjaman::select(
            'detail_kegiatan',
            'tgl_peminjaman',
            'batas_peminjaman',
            'jumlah_pinjam',
            'keterangan',
            'pengguna.nama_pengguna as pengguna',
            'barang.nama_barang as barang'
        )
            ->join('pengguna', 'pengguna.id_pengguna', '=', 'peminjaman.id_pengguna')
            ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
            ->get();
    }
    public function headings(): array
    {
        return [
            'No',
            'Detail Kegiatan',
            'Peminjam',
            'Barang',
            'Jumlah Pinjam',
            'Tanggal Pinjam',
            'Batas Pinjam',
            'Keterangan'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->no,
            $row->detail_kegiatan,
            $row->pengguna,
            $row->barang,
            $row->jumlah_pinjam,
            $row->tgl_peminjaman,
            $row->batas_peminjaman,
            $row->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header (baris 1): Bold + rata tengah
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Data (baris 2 dst): rata kiri
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    }
}
