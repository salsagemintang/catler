<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pemesanan_model extends Model
{
    protected $table="pemesanan";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
        'nama' , 'no_tran' , 'tgl_pesan'
        
        ];
}
