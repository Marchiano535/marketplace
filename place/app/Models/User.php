<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'full_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'role',
        'status',
        'rating',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function riwayatPemesanan()
    {
        return $this->hasMany(RiwayatPemesanan::class, 'idPelanggan');
    }

    // Methods untuk Pelanggan
    public function setCustomerId($id)
    {
        $this->id = $id;
        $this->save();
    }

    public function getCustomerId()
    {
        return $this->id;
    }

    public function showPelangganInfo()
    {
        return $this;
    }

    public function createPelanggan($data)
    {
        return self::create($data);
    }

    // Methods untuk User
    public function validateUser($username, $password)
    {
        return auth()->attempt(['username' => $username, 'password' => $password]);
    }

    public function loginUser($email, $password)
    {
        return auth()->attempt(['email' => $email, 'password' => $password]);
    }

    public function logoutUser()
    {
        auth()->logout();
    }

    public function registerUser($data)
    {
        return self::create($data);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
