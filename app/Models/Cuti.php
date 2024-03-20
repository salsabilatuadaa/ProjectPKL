<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $primaryKey = "id";
    protected $table = "cuti";
    protected $guarded = [];

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_id');
    }
}

