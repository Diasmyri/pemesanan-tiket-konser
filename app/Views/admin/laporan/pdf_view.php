<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px; 
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid #0095e8; 
            padding-bottom: 15px; 
        }
        .header h2 { 
            text-transform: uppercase; 
            margin: 0; 
            color: #111;
        }
        .header p { 
            margin: 5px 0 0; 
            color: #666; 
            font-size: 12px;
        }
        .meta-info {
            width: 100%;
            margin-bottom: 10px;
            font-size: 10px;
            color: #777;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th { 
            background-color: #0095e8; 
            color: white; 
            padding: 10px 8px; 
            text-transform: uppercase;
            font-size: 10px;
        }
        td { 
            padding: 8px; 
            border-bottom: 1px solid #eee; 
            color: #444;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        .footer-total {
            margin-top: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2><?= $title ?></h2>
        <p><?= $periode ?></p>
    </div>

    <table class="meta-info">
        <tr>
            <td style="border:none; padding:0;">Dicetak pada: <?= date('d/m/Y H:i') ?></td>
            <td style="border:none; padding:0;" class="text-right">Admin Panel - Ticketing System</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="80">Kode</th>
                <th>User</th>
                <th>Event</th>
                <th>Paket</th>
                <th width="40">Qty</th>
                <th width="100">Total</th>
                <th width="100">Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            $totalQty = 0;
            if (!empty($transaksi)): 
                $no = 1; 
                foreach ($transaksi as $t): 
                    $grandTotal += $t['total'];
                    $totalQty += $t['qty'];
            ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="fw-bold">TRX-<?= strtoupper($t['kode']) ?></td>
                <td><?= $t['user'] ?? 'Guest' ?></td>
                <td><?= $t['event'] ?></td>
                <td><?= $t['paket'] ?></td>
                <td class="text-center"><?= $t['qty'] ?></td>
                <td class="text-right fw-bold">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                <td class="text-center"><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
            
            <tr class="footer-total">
                <td colspan="5" class="text-right fw-bold" style="background: #eee;">GRAND TOTAL</td>
                <td class="text-center fw-bold" style="background: #eee;"><?= $totalQty ?></td>
                <td class="text-right fw-bold" style="background: #eee;">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                <td style="background: #eee;"></td>
            </tr>
            
            <?php else: ?>
            <tr>
                <td colspan="8" class="text-center" style="padding: 30px;">Data tidak ditemukan untuk periode ini.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right; font-size: 10px; color: #aaa;">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem.</p>
    </div>
</body>
</html>