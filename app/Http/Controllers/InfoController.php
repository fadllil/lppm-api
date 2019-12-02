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

    public function update($id, Request $request){

        $judul = $request->input('judul_info');
        $keterangan = $request->input('keterangan_info');
//        $filename = uniqid().'.pdf';
//        $file = $request->file('file_info')->move(storage_path('/'),$filename);
        DB::table('info')->where('id_info', $id)->update(['judul_info' => $judul, 'keterangan_info' => $keterangan]);
        return response()->json(['message' => 'Berhasil Edit Data'], 200);
    }

    public function save(Request $request){

        $data = new Info();
        $filename = uniqid().'.pdf';
        $server_ip = gethostbyname(gethostname());
        $url_file_info = 'http://'.$server_ip.'/'.('/lppm-rest-api/storage/').$filename;
        $data->judul_info = $request->input('judul_info');
        $data->keterangan_info = $request->input('keterangan_info');
        $data->file_info = $request->file('file_info')->move(storage_path('/'),$filename);
        $data->url_file_info = $request->input('url_file_info').$url_file_info;
        $data->save();

        return response()->json(['message' => 'Berhasil Tambah Data']);
    }
}
