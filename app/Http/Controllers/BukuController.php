<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Helper;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {

        $data = Buku::join('kategori_buku as kb', 'buku.id_kategori_buku', '=', 'kb.id_kategori_buku')->get();

        return Helper::responses_get($data);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //valid credential
         $validator = Validator::make($request->all(), [
            'id_kategori_buku' => 'required',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $data = new Buku();
        $data->id_kategori_buku =  $request->id_kategori_buku;
        $data->judul_buku =  $request->judul_buku;
        $data->pengarang =  $request->pengarang;
        $data->penerbit =  $request->penerbit;
        $data->thn_terbit =  $request->tahun_terbit;
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
    public function update(Request $request, $id)
    {
        //valid credential
        $validator = Validator::make($request->all(), [
            'id_kategori_buku' => 'required',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $data = Buku::find($id);

        if($data){
            $data->id_kategori_buku =  $request->id_kategori_buku;
            $data->judul_buku =  $request->judul_buku;
            $data->pengarang =  $request->pengarang;
            $data->penerbit =  $request->penerbit;
            $data->thn_terbit =  $request->tahun_terbit;
            $data->update();
    
            return Helper::responses_updated($data);
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data tidak dapat ditemnukan!'
            ];
            return response()->json($msg, 404); 
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Buku::find($id);

        return Helper::responses_delete($data);
    }
}
