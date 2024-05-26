<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiAtasan extends Model
{
    protected $primaryKey = "id";
    protected $table = "cuti_atasan";
    protected $guarded = [];

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti_id');
    }

    public function statusHR()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_id');
    }

    public function atasan()
    {
        return $this->belongsTo(Atasan::class, 'atasan_id', 'id');
    }

}
