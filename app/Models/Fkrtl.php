<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fkrtl extends Model
{
    use HasFactory;

    protected $table = 'fkrtl';
    protected $primaryKey = 'id_fkrtl';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_fkrtl',
        'kode_rumah_sakit',
        'nama_rumah_sakit',
        'jenis'
    ];
}
