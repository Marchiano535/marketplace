<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPemesanan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pemesanan';

    protected $fillable = [
        'idProduk',
        'idPelanggan',
        'tanggalPemesanan',
        'idPesanan',
        'statusPemesanan',
    ];

    protected $casts = [
        'tanggalPemesanan' => 'date',
    ];

    // Relationships
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'idPelanggan');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'idProduk');
    }

    public function pesanan()
    {
        return $this->belongsTo(Order::class, 'idPesanan');
    }

    // Methods
    public function addRiwayatPemesanan($idProduk, $idPelanggan, $tanggalPemesanan, $idPesanan, $statusPemesanan)
    {
        return self::create([
            'idProduk' => $idProduk,
            'idPelanggan' => $idPelanggan,
            'tanggalPemesanan' => $tanggalPemesanan,
            'idPesanan' => $idPesanan,
            'statusPemesanan' => $statusPemesanan,
        ]);
    }

    public function hapusRiwayatPemesanan()
    {
        return $this->delete();
    }

    public function showKaryawanInfo()
    {
        return $this;
    }
}
