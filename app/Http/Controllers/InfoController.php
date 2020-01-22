<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penelitian;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function info(){
        $info = DB::table('info')->get();

        return response()->json(
            $info
        );
    }

    public function update(Request $request){
        $id = $request->input('id_info');
        $judul = $request->input('judul_info');
        $keterangan = $request->input('keterangan_info');
        $filename = uniqid().'.pdf';
        $file = $request->file('file_info')->move(storage_path('/'),$filename);
        $url_file_info = $request->input('url_file_info').$filename;
        if (Info::where('id_info', $id)->first()){
            DB::table('info')->where('id_info', $id)->update(['judul_info' => $judul, 'keterangan_info' => $keterangan, 'file_info' => $file, 'url_file_info' => $url_file_info]);
            return response()->json([
                'error' => false,
                'message' => 'Berhasil Merubah Data'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Gagal Merubah Data'
            ]);
        }
    }

    public function save(Request $request){

        $data = new Info();
        $filename = uniqid().'.pdf';
        $server_ip = gethostbyname(gethostname());
        $url_file_info = 'http://'.$server_ip.'/'.('/lppm-rest-api/storage/').$filename;
        $data->judul_info = $request->input('judul_info');
        $data->keterangan_info = $request->input('keterangan_info');
        $data->file_info = $request->file('file_info')->move(storage_path('/'),$filename);
        $data->url_file_info = $request->input('url_file_info').$filename;//.$url_file_info;
        $data->save();

        if ($data){
            return response()->json([
                'error' => false,
                'message' => 'Berhasil Tambah Data'
            ]);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Gagal Tambah Data'
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->input('id_info');
        $info = DB::table('info')->where('id_info', $id)->delete();
        if ($info){
            return response()->json([
            'error' => false,
            'message' => 'Data Berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Data Gagal dihapus'
            ]);
        }
    }
}
