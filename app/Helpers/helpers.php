<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function responses_get($data)
    {
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
    public static function responses_added($data)
    {
        if($data){
            $msg = [
                'code' => 200,
                'result' => true,
                'message' => 'Data Berhasil Ditambahkan',
                'data' => $data
            ];

            return response()->json($msg, 200);
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data Gagal Ditambahkan!'
            ];

            return response()->json($msg, 404);
        }
      
    }
    public static function responses_updated($data)
    {
        if($data){
            $msg = [
                'code' => 200,
                'result' => true,
                'message' => 'Data Berhasil Diubah',
                'data' => $data
            ];
            return response()->json($msg, 200); 
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data Gagal Diubah!'
            ];
            return response()->json($msg, 404); 
        }
      
    }
    public static function responses_delete($data)
    {
        if($data){
            $data->delete();
    
            if($data){
                $msg = [
                    'code' => 200,
                    'result' => true,
                    'message' => 'Data Berhasil dihapus',
                    'data' => $data
                ];
                return response()->json($msg, 200); 
            }else{
                $msg = [
                    'code' => 404,
                    'result' => false,
                    'message' => 'Data Gagal dihapus!'
                ];
                return response()->json($msg, 404); 
            }
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Data tidak dapat ditemnukan!'
            ];
            return response()->json($msg, 404); 
        }
      
    }
    public static function responses_pengembalian($data)
    {
        if($data){
            $msg = [
                'code' => 200,
                'result' => true,
                'message' => 'Buku Berhasil Dikembalikan',
                'data' => $data
            ];
            return response()->json($msg, 200); 
        }else{
            $msg = [
                'code' => 404,
                'result' => false,
                'message' => 'Buku Gagal Dikembalikan!'
            ];
            return response()->json($msg, 404); 
        }
      
    }
}