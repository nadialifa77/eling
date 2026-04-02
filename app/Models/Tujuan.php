<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    protected $fillable = ['user_id', 'judul'];

    public function subTujuans()
    {
        return $this->hasMany(SubTujuan::class);
    }
}
