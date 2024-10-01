<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaModel;

class AnggotaController extends Controller
{
    public function anggotatampil()
    {
        $dataanggota = AnggotaModel::orderBy('id_anggota', 'ASC')->paginate(5);
        return view('halaman.view_anggota', ['anggota' => $dataanggota]);
    }

    public function anggotatambah(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required',
            'nama_anggota' => 'required',
            'prodi' => 'required',
            'no_hp' => 'required',
        ]);

        AnggotaModel::create($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function anggotahapus(AnggotaModel $anggota)
    {
        $anggota->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus!');
    }

    public function anggotaedit(AnggotaModel $anggota, Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required',
            'nama_anggota' => 'required',
            'prodi' => 'required',
            'no_hp' => 'required',
        ]);

        $anggota->update($validatedData);

        return redirect()->back()->with('success', 'Anggota berhasil diperbarui!');
    }
}
