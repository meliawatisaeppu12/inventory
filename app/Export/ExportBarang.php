<?php

namespace App\Export;

use App\Models\barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportBarang implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $no = 0;

    public function collection()
    {
        return barang::select(
            'kode_barang',
            'kode_lokasi',
            'nama_barang',
            'nomor_registrasi',
            'jumlah_barang',
            'jumlah_tersedia'
        )->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Kode Lokasi',
            'Nama Barang',
            'Nomor Registrasi',
            'Jumlah Barang',
            'Jumlah Tersedia'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->no,
            $row->kode_barang,
            $row->kode_lokasi,
            $row->nama_barang,
            $row->nomor_registrasi,
            $row->jumlah_barang,
            $row->jumlah_tersedia,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header (baris 1): Bold + rata tengah
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Data (baris 2 dst): rata kiri
        $sheet->getStyle('A2:G' . $sheet->getHighestRow())
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    }
}
