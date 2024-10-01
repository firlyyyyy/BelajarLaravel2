<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamModel;
use App\Models\BukuModel;
use App\Models\PetugasModel;
use App\Models\AnggotaModel;

class PinjamController extends Controller
{
    public function pinjamtampil()
    {
        $datapinjam = PinjamModel::orderby('id_pinjam', 'ASC')
            ->paginate(5);

        $datapetugas = PetugasModel::all();
        $dataanggota = AnggotaModel::all();
        $databuku = BukuModel::all();

        return view('halaman.view_pinjam', ['pinjam' => $datapinjam, 'petugas' => $datapetugas, 'anggota' => $dataanggota, 'buku' => $databuku]);
    }

    public function pinjamtambah(Request $request)
    {
        $validateData = $request->validate([
            'id_petugas' => 'required',
            'id_anggota' => 'required',
            'id_buku' => 'required'
        ]);

        PinjamModel::create([
            'id_petugas' => $request->id_petugas,
            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
        ]);

        return redirect('/pinjam');
    }

    public function pinjamhapus($id_pinjam)
    {
        $datapinjam = PinjamModel::find($id_pinjam);
        $datapinjam->delete();

        return redirect()->back();
    }

    public function pinjamedit($id_pinjam, Request $request)
    {
        $validateData = $request->validate([
            'id_petugas' => 'required',
            'id_anggota' => 'required',
            'id_buku' => 'required'
        ]);

        $id_pinjam = PinjamModel::find($id_pinjam);
        $id_pinjam->id_petugas = $request->id_petugas;
        $id_pinjam->id_anggota = $request->id_anggota;
        $id_pinjam->id_buku = $request->id_buku;

        $id_pinjam->save();

        return redirect()->back();
    }
}
