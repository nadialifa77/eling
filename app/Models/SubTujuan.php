<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTujuan extends Model
{
    protected $fillable = ['tujuan_id', 'judul', 'is_done'];

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }
}
