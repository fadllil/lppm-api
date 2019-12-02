<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penelitian;

class PenelitianController extends Controller
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

    public function show(){
        $penelitian = DB::table('penelitian')
            ->join('fakultas', 'penelitian.id_fakultas', '=', 'fakultas.id_fakultas')
            ->join('cluster', 'penelitian.id_cluster', '=', 'cluster.id_cluster')
            ->select('penelitian.*', 'fakultas.nama_fakultas', 'cluster.nama_cluster')
            ->get();


            return response()->json(
                $penelitian
            );
        }
    //
}
