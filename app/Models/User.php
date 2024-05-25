<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function profileAdmIsComplete()
    {
        return $this->admin()->exists();
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    public function profileKarIsComplete()
    {
        return $this->karyawan()->exists();
    }

    public function atasan()
    {
        return $this->hasOne(Atasan::class);
    }

    public function profileAtsIsComplete()
    {
        return $this->atasan()->exists();
    }

    public function kepegawaian()
    {
        return $this->hasOne(Kepegawaian::class);
    }

    public function profileKepIsComplete()
    {
        return $this->kepegawaian()->exists();
    }
    
}
