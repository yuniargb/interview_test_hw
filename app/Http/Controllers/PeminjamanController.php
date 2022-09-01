<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Helper;
use Illuminate\Support\Facades\Validator;


class PeminjamanController extends Controller
{
    public function index()
    {

        $data = Peminjaman::select('peminjaman.id_peminjaman','tgl_pinjam','tgl_kembali','b.judul_buku','kb.nama_kategori','u.name as user')
        ->join('buku as b', 'peminjaman.id_buku', '=', 'b.id_buku')
        ->join('kategori_buku as kb', 'b.id_kategori_buku', '=', 'kb.id_kategori_buku')
        ->join('users as u', 'peminjaman.id_user', '=', 'u.id')
                ->get();

        if(count($data)){
            $msg = [
                'code' => 200,
                'result' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ];
            return response()->json($msg, 200); 
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data tidak dapat ditemukan!'
            ];
            return response()->json($msg, 404); 
        }
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function peminjaman(Request $request)
    {
          //valid credential
          $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_buku' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $data = new Peminjaman();
        $data->id_user =  $request->id_user;
        $data->tgl_pinjam =  date('Y-m-d');
        $data->id_buku =  $request->id_buku;
        $data->status_peminjaman =  0;
        $data->save();

        return Helper::responses_added($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pengembalian(Request $request, $id)
    {

        $data = Peminjaman::find($id);

        if($data){
            $data->tgl_kembali =  date('Y-m-d');
            $data->status_peminjaman =  1;
            $data->update();
    
            return Helper::responses_pengembalian($data);
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data tidak dapat ditemnukan!'
            ];
            return response()->json($msg, 404); 
        }
       
    }

}
