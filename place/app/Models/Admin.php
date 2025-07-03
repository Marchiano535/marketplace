<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'phone',
        'address',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function pelangganManaged()
    {
        return $this->hasMany(User::class, 'admin_id');
    }

    // Methods
    public function showPelangganInfo($pelanggan)
    {
        return $pelanggan;
    }

    public function editKaryawanStatus($karyawan, $status)
    {
        $karyawan->update(['status' => $status]);
    }

    public function editPelangganEmail($pelanggan, $email)
    {
        $pelanggan->update(['email' => $email]);
    }

    public function tambahProduk($data)
    {
        return Product::create($data);
    }
}
