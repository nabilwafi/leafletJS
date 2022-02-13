<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function index() {
        $data = DB::table('markers')->get();
        return view('admin.index', compact('data'));
    }

    public function create() {
        return view('admin.create');
    }
    
    public function store(Request $request) {

        $validated = $request->validate([
            'nama_gedung' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = array(
            'nama_gedung' => $request->nama_gedung,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        );

        if ($image = $request->file('foto')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $data['foto'] = $postImage;
        }

        DB::table('markers')->insert($data);
        return redirect()->route('admin.dashboard');
    }

    public function edit(Request $request, $id) {
        $data = DB::table('markers')->where('id', $id)->first();
        return view('admin.edit', compact('data'));
    }

    public function update(Request $request, $id) {

        $validated = $request->validate([
            'nama_gedung' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = array(
            'nama_gedung' => $request->nama_gedung,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        );

        $old_foto = $request->old_foto;

        if ($image = $request->file('foto')) {
            if($old_foto) {
                unlink('uploads/'.$old_foto);
            }

            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);

            $data['foto'] = $postImage;
        }

        DB::table('markers')->where("id", $id)->update($data);
        return redirect()->route('admin.dashboard');
    }

    public function delete($id) {
        $data = DB::table('markers')->where("id", $id)->first();
        
        if($data->foto) {
            unlink('uploads/'.$data->foto);
        }
        
        DB::table('markers')->where("id", $id)->delete();

        return redirect()->route('admin.dashboard');
    }   


}
