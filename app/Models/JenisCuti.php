<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $primaryKey = "id";
    protected $table = "jenis_cuti";
    protected $fillable = [
        "id",
        "nama_cuti"
    ];
}
