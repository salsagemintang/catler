<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penitipan_model extends Model
{
    protected $table="penitipan";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
        'jenis_hewan' , 'fasilitas' , 'durasi' , 'harga'
        
        ];
}
