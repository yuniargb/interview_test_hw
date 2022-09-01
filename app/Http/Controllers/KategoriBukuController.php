<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBuku;
use Helper;
use Illuminate\Support\Facades\Validator;

class KategoriBukuController extends Controller
{
    public function index()
    {

        $data = KategoriBuku::all();
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
            'nama_kategori' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $data = new KategoriBuku();
        $data->nama_kategori =  $request->nama_kategori;
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
            'nama_kategori' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $data = KategoriBuku::find($id);

        if($data){
            $data->nama_kategori =  $request->nama_kategori;
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
        $data = KategoriBuku::find($id);
        return Helper::responses_delete($data);
    }
}
