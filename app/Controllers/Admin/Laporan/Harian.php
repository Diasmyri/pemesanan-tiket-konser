<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Harian extends BaseController
{
    private function getFilteredData()
    {
        $db = \Config\Database::connect();
        
        $tgl_awal  = $this->request->getGet('tgl_awal');
        $tgl_akhir = $this->request->getGet('tgl_akhir');
        $bln_awal  = $this->request->getGet('bln_awal');
        $bln_akhir = $this->request->getGet('bln_akhir');

        $builder = $db->table('orders o')
            ->select('o.id as kode, u.username as user, e.title as event, tt.name as paket, o.total_price as total, o.created_at, o.qty')
            ->join('users u', 'u.id = o.user_id', 'left')
            ->join('events e', 'e.id = o.event_id', 'left')
            ->join('ticket_types tt', 'tt.id = o.ticket_type_id', 'left')
            ->where('o.status', 'paid');

        if ($tgl_awal && $tgl_akhir) {
            $builder->where("DATE(o.created_at) >=", $tgl_awal)
                    ->where("DATE(o.created_at) <=", $tgl_akhir);
        } elseif ($bln_awal && $bln_akhir) {
            $builder->where("DATE_FORMAT(o.created_at, '%Y-%m') >=", $bln_awal)
                    ->where("DATE_FORMAT(o.created_at, '%Y-%m') <=", $bln_akhir);
        } else {
            $builder->where("DATE_FORMAT(o.created_at, '%Y-%m')", date('Y-m'));
        }

        return $builder->orderBy('o.created_at', 'DESC')->get()->getResultArray();
    }

    public function index()
    {
        $data = [
            'title'     => 'Laporan Transaksi Tiket Konser',
            'transaksi' => $this->getFilteredData(),
            'periode'   => $this->getPeriodeText(),
            'filter'    => [
                'tgl_awal'  => $this->request->getGet('tgl_awal'),
                'tgl_akhir' => $this->request->getGet('tgl_akhir'),
                'bln_awal'  => $this->request->getGet('bln_awal'),
                'bln_akhir' => $this->request->getGet('bln_akhir'),
            ]
        ];
        return view('admin/laporan/harian', $data);
    }

    private function getPeriodeText()
    {
        $tgl_awal = $this->request->getGet('tgl_awal');
        $bln_awal = $this->request->getGet('bln_awal');
        if ($tgl_awal) return "Periode: $tgl_awal s/d " . $this->request->getGet('tgl_akhir');
        if ($bln_awal) return "Periode Bulan: $bln_awal s/d " . $this->request->getGet('bln_akhir');
        return "Periode: Bulan Ini (" . date('F Y') . ")";
    }

    public function exportPdf()
    {
        $dompdf = new Dompdf();
        $dataTransaksi = $this->getFilteredData();
        
        $data = [
            'title'     => "Laporan Penjualan Tiket Konser",
            'transaksi' => $dataTransaksi,
            'periode'   => $this->getPeriodeText()
        ];
        
        $html = view('admin/laporan/pdf_view', $data); 
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Laporan_Tiket_Konser.pdf", ["Attachment" => false]);
    }

public function exportExcel()
{
    $transaksi = $this->getFilteredData();
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Penjualan_Tiket_" . date('Ymd') . ".xls");

    echo "
    <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'>
    <head>
        <style>
            .title { font-size: 16pt; font-weight: bold; text-align: center; }
            .periode { font-size: 11pt; text-align: center; }
            .header-table { background-color: #0095e8; color: #ffffff; font-weight: bold; border: 0.5pt solid #000; }
            .cell { border: 0.5pt solid #ccc; }
            .text-center { text-align: center; }
            .text-right { text-align: right; }
            /* Biar angka gak berubah jadi tanggal atau format aneh */
            .number { mso-number-format:'\#\,\#\#0'; }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td colspan='8' class='title' style='height:40px; vertical-align:middle;'>LAPORAN PENJUALAN TIKET KONSER</td>
            </tr>
            <tr>
                <td colspan='8' class='periode' style='height:25px; vertical-align:middle;'>Periode: " . $this->getPeriodeText() . "</td>
            </tr>
            <tr><td colspan='8' style='height:15px;'></td></tr>

            <tr>
                <th width='50' class='header-table'>No</th>
                <th width='120' class='header-table'>Kode</th>
                <th width='150' class='header-table'>Username</th>
                <th width='200' class='header-table'>Event</th>
                <th width='120' class='header-table'>Tiket</th>
                <th width='60' class='header-table'>QTY</th>
                <th width='130' class='header-table'>Total</th>
                <th width='150' class='header-table'>Waktu</th>
            </tr>";

    $no = 1;
    $grandTotal = 0;
    $totalQty = 0;

    if (!empty($transaksi)) {
        foreach ($transaksi as $t) {
            $grandTotal += $t['total'];
            $totalQty += $t['qty'];
            echo "
            <tr>
                <td class='cell text-center'>$no</td>
                <td class='cell text-center' style='font-weight:bold;'>TRX-".strtoupper($t['kode'])."</td>
                <td class='cell'>".($t['user'] ?? 'Guest')."</td>
                <td class='cell'>".$t['event']."</td>
                <td class='cell'>".$t['paket']."</td>
                <td class='cell text-center'>".$t['qty']."</td>
                <td class='cell text-right number'>".$t['total']."</td>
                <td class='cell text-center'>".date('d/m/Y H:i', strtotime($t['created_at']))."</td>
            </tr>";
            $no++;
        }

        // Row Grand Total
        echo "
        <tr style='font-weight:bold; background-color: #f2f2f2;'>
            <td colspan='5' class='cell text-right' style='height:30px; vertical-align:middle;'>GRAND TOTAL:</td>
            <td class='cell text-center'>$totalQty</td>
            <td class='cell text-right number'>$grandTotal</td>
            <td class='cell'></td>
        </tr>";
    }

    echo "
        </table>
    </body>
    </html>";
    exit;
}

}