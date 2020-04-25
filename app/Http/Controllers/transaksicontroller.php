<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\transaksi_model;
use App\penitipan_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class transaksicontroller extends Controller
{
    public function store(Request $req){
          if(Auth::user()->level=="pelanggan"){

        $validator=Validator::make($req->all(),
        [
            'id_penitipan'=>'required',
            'qty'=>'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $id_penitipan=$req->id_penitipan;
            $harga=DB::table('penitipan')->where('id',$id_penitipan)->first();
            $harga_total=$harga->harga;
            $subtotal=$harga_total*$req->qty;

        $simpan=transaksi_model::create([
            'id_penitipan'=>$req->id_penitipan,
            'qty'=>$req->qty,
            'subtotal'=>$subtotal
        ]);
        $status=1;
        $message="Data Berhasil Ditambahkan!";
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
          }
     }
    public function tampil_transaksi()
    {
        $data_pelanggan=transaksi_model::count();
        $data_pelanggan1=transaksi_model::all();
        return Response()->json(['count'=> $data_pelanggan, 'pelanggan'=> $data_pelanggan1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
         $validator=Validator::make($req->all(),
        [
            'id_penitipan'=>'required',
            'qty'=>'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $id_penitipan=$req->id_penitipan;
            $harga=DB::table('penitipan')->where('id',$id_penitipan)->first();
            $harga_total=$harga->harga;
            $subtotal=$harga_total*$req->qty;

        $ubah=transaksi_model::where('id',$id)->update([
            'id_penitipan'=>$req->id_penitipan,
            'qty'=>$req->qty,
            'subtotal'=>$subtotal
        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=transaksi_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
