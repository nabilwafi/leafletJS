<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class titikController extends Controller
{

    public function titik_gedung() {
        $titik_gedung = DB::table('markers')->select('id','latitude', 'longitude')->get();
        return json_encode($titik_gedung);
    }

    public function info_gedung($id = '') {
        $data_gedung = DB::table('markers')->select('nama_gedung', 'alamat', 'deskripsi' ,'foto')->where('id', $id)->first();
        return json_encode($data_gedung);
    }

}
