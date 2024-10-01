<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\PetugasModel;

class PetugasController extends Controller
{
    public function petugastampil()
    {
        $datapetugas = PetugasModel::orderby('id_petugas', 'ASC')
            ->paginate(5);

        return view('halaman.view_petugas', ['petugas' => $datapetugas]);
    }

    public function petugastambah(Request $request)
    {
        $validatedData = $request->validate([
            'nama_petugas' => 'required',
            'no_hp' => 'required'
        ]);

        PetugasModel::create([
            'nama_petugas' => $request->nama_petugas,
            'no_hp' => $request->no_hp
        ]);

        return redirect('/petugas');
    }

    public function petugashapus($id_petugas)
    {
        $datapetugas = PetugasModel::find($id_petugas);
        $datapetugas->delete();

        return redirect()->back();
    }

    public function petugasedit($id_petugas, Request $request)
    {
        $validatedData = $request->validate([
            'nama_petugas' => 'required',
            'no_hp' => 'required'
        ]);

        $id_petugas = PetugasModel::find($id_petugas);
        $id_petugas->nama_petugas = $request->nama_petugas;
        $id_petugas->no_hp = $request->no_hp;

        $id_petugas->save();

        return redirect()->back();
    }
}
