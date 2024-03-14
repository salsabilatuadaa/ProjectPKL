<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepegawaian extends Model
{
    protected $primaryKey = "id";
    protected $table = "kepegawaian";

    public function user()
    {
        return $this->hasOne(User::class);
    }
    
}
