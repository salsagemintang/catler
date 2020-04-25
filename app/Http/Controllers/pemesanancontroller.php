<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\pemesanan_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class pemesanancontroller extends Controller
{
     public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_pemesanan=pemesanan_model::get();
            return response()->json($dt_pemesanan);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }}

    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'no_tran'=>'required',
            'tgl_pesan'=>'required',

        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=pemesanan_model::create([
            'nama'=>$req->nama,
            'no_tran'=>$req->no_tran,
            'tgl_pesan'=>$req->tgl_pesan,
            
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_pemesanan()
    {
        $data_pemesanan=pemesanan_model::count();
        $data_pemesanan1=pemesanan_model::all();
        return Response()->json(['count'=> $data_pemesanan, 'pemesanan'=> $data_pemesanan1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'no_tran'=>'required',
            'tgl_pesan'=>'required',

        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=pemesanan_model::where('id',$id)->update([
            'nama'=>$req->nama,
            'no_tran'=>$req->no_tran,
            'tgl_pesan'=>$req->tgl_pesan,

        ]);

        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=pemesanan_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
