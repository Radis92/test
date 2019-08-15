<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['kode', 'nama', 'semester'];

    public function karyawan()
    {
        return $this->belongsToMany(Karyawan::class)->withPivot(['nilai']);
    }
}
