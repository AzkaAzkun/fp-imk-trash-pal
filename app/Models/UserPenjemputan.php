<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPenjemputan extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    protected $table = 'user_penjemputan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'bank_sampah_id',
        'tanggal_penjemputan',
        'alamat_penjemputan',
        'volume',
        'status',
        'nomor_invoice',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank_sampah()
    {
        return $this->belongsTo(User::class, 'bank_sampah_id');
    }
}
