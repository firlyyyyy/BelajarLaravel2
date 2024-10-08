<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamModel extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primarykey = 'id_pinjam';

    protected $fillable = [
        'id_pinjam',
        'id_petugas',
        'id_anggota',
        'id_buku'
    ];

    public function petugas()
    {
        return $this->belongsTo('App\Models\PetugasModel', 'id_petugas');
    }

    public function anggota()
    {
        return $this->belongsTo('App\Models\AnggotaModel', 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo('App\Models\BukuModel', 'id_buku');
    }
}
