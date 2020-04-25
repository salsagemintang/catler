<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_model extends Model
{
    protected $table="transaksi";
  protected $primaryKey="id";
  public $timestamps= false;
  protected $fillable = [
    'id_penitipan' , 'qty' , 'subtotal'
  ];

  public function penitipan_model(){
        return $this->belongsTo('App\penitipan_model', 'id_penitipan');
    }
   
}
