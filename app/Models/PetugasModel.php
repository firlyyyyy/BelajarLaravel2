<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasModel extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    protected $primarykey = 'id_petugas';

    protected $fillable = [
        'id_petugas',
        'nama_petugas',
        'no_hp'
    ];
}
