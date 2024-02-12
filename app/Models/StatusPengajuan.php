<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    protected $primaryKey = "id";
    protected $table = "status_pengajuan";
    protected $fillable = [
        "id",
        "status"
    ];
}
