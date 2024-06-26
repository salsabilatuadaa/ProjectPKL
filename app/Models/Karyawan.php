<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $primaryKey = "id";
    protected $table = "karyawan";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atasan()
    {
        return $this->belongsTo(Atasan::class);
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
    
}
