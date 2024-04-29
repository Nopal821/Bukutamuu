<?php
// app/Models/Tamu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tamu extends Model
{
    // app/Models/Tamu.php
protected $fillable = ['nama', 'alamat', 'no_telp', 'tujuan_kunjungan', 'tgl_kunjungan', 'jam_kunjungan','foto'];

public $timestamps = true;


}
?>