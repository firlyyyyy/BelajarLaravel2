<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function bukutampil()
    {
        $databuku = BukuModel::orderBy('kode_buku', 'ASC')->paginate(5);
        return view('halaman.view_buku', ['buku' => $databuku]);
    }

    public function bukutambah(Request $request)
    {
        $validatedData = $request->validate([
            'kode_buku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'kategori' => 'required',
        ]);

        BukuModel::create($validatedData);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function bukuhapus($id_buku)
    {
        $databuku = BukuModel::find($id_buku);
        $databuku->delete();

        return redirect()->back();
    }

    public function bukuedit(BukuModel $buku, Request $request)
    {
        $validatedData = $request->validate([
            'kode_buku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'kategori' => 'required',
        ]);

        $buku->update($validatedData);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }
}
