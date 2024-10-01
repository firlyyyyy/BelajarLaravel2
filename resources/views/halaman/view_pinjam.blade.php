@extends('index')
@section('title', 'Peminjaman')

@section('isihalaman')
    <h3 class="text-center">Data Peminjaman Buku</h3>
    <h3 class="text-center">Perpustakaan Universitas Semarang</h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPinjamTambah"> 
        Tambah Data Peminjaman 
    </button>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th align="center">No</th>
                <th align="center">ID Pinjam</th>
                <th align="center">Nama Petugas</th>
                <th align="center">Nama Anggota</th>
                <th align="center">Judul Buku</th>
                <th align="center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjam as $index => $p)
                <tr>
                    <td align="center" scope="row">{{ $index + $pinjam->firstItem() }}</td>
                    <td align="center">{{ $p->id_pinjam }}</td>
                    <td>{{ $p->petugas->nama_petugas }}</td>
                    <td>{{ $p->anggota->nama_anggota }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalPinjamEdit{{ $p->id_pinjam }}"> 
                            Edit
                        </button>

                        <!-- Awal Modal EDIT data Peminjaman -->
                        <div class="modal fade" id="modalPinjamEdit{{ $p->id_pinjam }}" tabindex="-1" role="dialog" aria-labelledby="modalPinjamEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPinjamEditLabel">Form Edit Data Peminjaman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pinjam/edit/{{ $p->id_pinjam }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="form-group row">
                                                <label for="id_pinjam" class="col-sm-4 col-form-label">ID Pinjam</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="id_pinjam" name="id_pinjam" value="{{ $p->id_pinjam }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="id_petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="id_petugas" name="id_petugas">
                                                        @foreach ($petugas as $pt)
                                                            <option value="{{ $pt->id_petugas }}" {{ $pt->id_petugas == $p->id_petugas ? 'selected' : '' }}>{{ $pt->nama_petugas }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="id_anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="id_anggota" name="id_anggota">
                                                        @foreach ($anggota as $a)
                                                            <option value="{{ $a->id_anggota }}" {{ $a->id_anggota == $p->id_anggota ? 'selected' : '' }}>{{ $a->nama_anggota }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="id_buku" class="col-sm-4 col-form-label">Judul Buku</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="id_buku" name="id_buku">
                                                        @foreach ($buku as $bk)
                                                            <option value="{{ $bk->id_buku }}" {{ $bk->id_buku == $p->id_buku ? 'selected' : '' }}>{{ $bk->judul }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data Peminjaman -->

                        <a href="pinjam/hapus/{{ $p->id_pinjam }}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        Halaman: {{ $pinjam->currentPage() }} <br />
        Jumlah Data: {{ $pinjam->total() }} <br />
        Data Per Halaman: {{ $pinjam->perPage() }} <br />
        {{ $pinjam->links() }}
    </div>

    <!-- Awal Modal tambah data Peminjaman -->
    <div class="modal fade" id="modalPinjamTambah" tabindex="-1" role="dialog" aria-labelledby="modalPinjamTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPinjamTambahLabel">Form Input Data Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pinjam/tambah" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="id_petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="id_petugas" name="id_petugas">
                                    <option value="" disabled selected>Pilih Nama Petugas</option>
                                    @foreach($petugas as $pt)
                                        <option value="{{ $pt->id_petugas }}">{{ $pt->nama_petugas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="id_anggota" name="id_anggota">
                                    <option value="" disabled selected>Pilih Nama Anggota</option>
                                    @foreach($anggota as $a)
                                        <option value="{{ $a->id_anggota }}">{{ $a->nama_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_buku" class="col-sm-4 col-form-label">Judul Buku</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="id_buku" name="id_buku">
                                    <option value="" disabled selected>Pilih Judul Buku</option>
                                    @foreach($buku as $bk)
                                        <option value="{{ $bk->id_buku }}">{{ $bk->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </Sepertinya kamu ingin memperbaiki kode untuk tampilan data peminjaman buku di aplikasi Laravel. Berikut adalah beberapa saran perbaikan dan pengorganisasian yang bisa membuat kode lebih bersih dan fungsional:

1. **Menggunakan Blade Component**: Untuk bagian modal, kamu bisa mempertimbangkan untuk membuat komponen Blade terpisah agar lebih modular dan mudah dikelola.

2. **Peningkatan Responsiveness**: Pastikan tabel dan modals responsif agar tampil dengan baik di perangkat yang berbeda.

3. **Validasi Form**: Tambahkan validasi untuk memastikan data yang dimasukkan benar dan tidak kosong sebelum diproses.

4. **Penggunaan `route()`**: Ganti hardcoded URL dengan `route()` untuk menjaga konsistensi dan kemudahan pemeliharaan.

Berikut adalah contoh perbaikan untuk bagian dari kode yang kamu berikan:

```blade
@extends('index')
@section('title', 'Peminjaman')

@section('isihalaman')
    <h3 class="text-center">Data Peminjaman Buku</h3>
    <h3 class="text-center">Perpustakaan Universitas Semarang</h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPinjamTambah"> 
        Tambah Data Peminjaman 
    </button>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">ID Pinjam</th>
                <th class="text-center">Nama Petugas</th>
                <th class="text-center">Nama Anggota</th>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjam as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + $pinjam->firstItem() }}</td>
                    <td class="text-center">{{ $p->id_pinjam }}</td>
                    <td>{{ $p->petugas->nama_petugas }}</td>
                    <td>{{ $p->anggota->nama_anggota }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalPinjamEdit{{ $p->id_pinjam }}"> 
                            Edit
                        </button>
                        <a href="{{ route('pinjam.hapus', $p->id_pinjam) }}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                @include('modals.editPinjam', ['p' => $p, 'petugas' => $petugas, 'anggota' => $anggota, 'buku' => $buku])
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div>
        Halaman: {{ $pinjam->currentPage() }} <br />
        Jumlah Data: {{ $pinjam->total() }} <br />
        Data Per Halaman: {{ $pinjam->perPage() }} <br />
        {{ $pinjam->links() }}
    </div>

    <!-- Modal Tambah -->
    @include('modals.tambahPinjam', ['petugas' => $petugas, 'anggota' => $anggota, 'buku' => $buku])
@endsection
