<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = "id";
    protected $table = "admin";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
