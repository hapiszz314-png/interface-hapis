<?php

// 1. Membuat Interface MetodePembayaran
interface MetodePembayaran {
    public function prosesBayar($jumlah, $keterangan);
    public function getNamaMetode();
}

// 2. Class TransferBank (Biaya Admin 0%)
class TransferBank implements MetodePembayaran {
    private $nomorRekening;

    public function __construct($nomorRekening) {
        $this->nomorRekening = $nomorRekening;
    }

    public function getNamaMetode() {
        return "Transfer Bank";
    }

    public function prosesBayar($jumlah, $keterangan) {
        $biayaAdmin = 0;
        $total = $jumlah + $biayaAdmin;

        echo "========================================<br>";
        echo "   RINCIAN PEMBAYARAN: " . strtoupper($this->getNamaMetode()) . "<br>";
        echo "========================================<br>";
        echo "No. Rekening   : " . $this->nomorRekening . "<br>";
        echo "Keterangan     : " . $keterangan . "<br>";
        echo "Jumlah         : Rp " . number_format($jumlah, 0, ',', '.') . "<br>";
        echo "Biaya Admin    : Rp " . number_format($biayaAdmin, 0, ',', '.') . "<br>";
        echo "----------------------------------------<br>";
        echo "Total Bayar    : Rp " . number_format($total, 0, ',', '.') . "<br>";
        echo "========================================<br><br>";

        return true;
    }
}

// 3. Class QRIS (Biaya Admin 0.7%)
class QRIS implements MetodePembayaran {
    public function getNamaMetode() {
        return "QRIS";
    }

    public function prosesBayar($jumlah, $keterangan) {
        $biayaAdmin = $jumlah * 0.007; // 0.7%
        $total = $jumlah + $biayaAdmin;

        echo "========================================<br>";
        echo "   RINCIAN PEMBAYARAN: " . strtoupper($this->getNamaMetode()) . "<br>";
        echo "========================================<br>";
        echo "Keterangan     : " . $keterangan . "<br>";
        echo "Jumlah         : Rp " . number_format($jumlah, 0, ',', '.') . "<br>";
        echo "Biaya Admin    : Rp " . number_format($biayaAdmin, 0, ',', '.') . "<br>";
        echo "----------------------------------------<br>";
        echo "Total Bayar    : Rp " . number_format($total, 0, ',', '.') . "<br>";
        echo "========================================<br><br>";

        return true;
    }
}

// 4. Class KartuKredit (Biaya Admin 2.5%)
class KartuKredit implements MetodePembayaran {
    private $nomorKartu;

    public function __construct($nomorKartu) {
        $this->nomorKartu = $nomorKartu;
    }

    public function getNamaMetode() {
        return "Kartu Kredit";
    }

    public function prosesBayar($jumlah, $keterangan) {
        $biayaAdmin = $jumlah * 0.025; // 2.5%
        $total = $jumlah + $biayaAdmin;
        
        // Mengambil 4 digit terakhir nomor kartu
        $empatDigitTerakhir = substr($this->nomorKartu, -4);

        echo "========================================<br>";
        echo "   RINCIAN PEMBAYARAN: " . strtoupper($this->getNamaMetode()) . "<br>";
        echo "========================================<br>";
        echo "No. Kartu      : ****-****-****-" . $empatDigitTerakhir . "<br>";
        echo "Keterangan     : " . $keterangan . "<br>";
        echo "Jumlah         : Rp " . number_format($jumlah, 0, ',', '.') . "<br>";
        echo "Biaya Admin    : Rp " . number_format($biayaAdmin, 0, ',', '.') . "<br>";
        echo "----------------------------------------<br>";
        echo "Total Bayar    : Rp " . number_format($total, 0, ',', '.') . "<br>";
        echo "========================================<br><br>";

        return true;
    }
}

// === CONTOH PENGUJIAN ===
$jumlahTransaksi = 500000;
$keteranganTransaksi = "Pembelian Buku Pemrograman";

$bank = new TransferBank("1234567890");
$bank->prosesBayar($jumlahTransaksi, $keteranganTransaksi);

$qris = new QRIS();
$qris->prosesBayar($jumlahTransaksi, $keteranganTransaksi);

$cc = new KartuKredit("4532123456789876");
$cc->prosesBayar($jumlahTransaksi, $keteranganTransaksi);
?>
