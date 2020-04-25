<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\penitipan_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class penitipancontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_penitipan=penitipan_model::get();
            return response()->json($dt_penitipan);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'jenis_hewan'=>'required',
            'fasilitas'=>'required',
            'durasi'=>'required',
            'harga'=>'required',

        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=penitipan_model::create([
            'jenis_hewan'=>$req->jenis_hewan,
            'fasilitas'=>$req->fasilitas,
            'durasi'=>$req->durasi,
            'harga'=>$req->harga,

        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_penitipan()
    {
        $data_penitipan=penitipan_model::count();
        $data_penitipan1=penitipan_model::all();
        return Response()->json(['count'=> $data_penitipan, 'penitipan'=> $data_penitipan1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'jenis_hewan'=>'required',
            'fasilitas'=>'required',
            'durasi'=>'required',
            'harga'=>'required',

        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=penitipan_model::where('id',$id)->update([
            'jenis_hewan'=>$req->jenis_hewan,
            'fasilitas'=>$req->fasilitas,
            'durasi'=>$req->durasi,
            'harga'=>$req->harga,

        ]);

        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=penitipan_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}