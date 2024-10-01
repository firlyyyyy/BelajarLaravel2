@extends('index')
@section('title', 'Buku')

@section('isihalaman')
    <h3 class="text-center">Daftar Buku Perpustakaan Universitas Semarang</h3>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBukuTambah"> 
        Tambah Data Buku 
    </button>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th align="center">No</th>
                <th align="center">ID Buku</th>
                <th align="center">Kode Buku</th>
                <th align="center">Judul Buku</th>
                <th align="center">Pengarang</th>
                <th align="center">Kategori</th>
                <th align="center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($buku as $index => $bk)
                <tr>
                    <td align="center">{{ $index + $buku->firstItem() }}</td>
                    <td>{{ $bk->id_buku }}</td>
                    <td>{{ $bk->kode_buku }}</td>
                    <td>{{ $bk->judul }}</td>
                    <td>{{ $bk->pengarang }}</td>
                    <td>{{ $bk->kategori }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalBukuEdit{{ $bk->id_buku }}"> 
                            Edit
                        </button>
                        
                        <!-- Modal Edit Data Buku -->
                        <div class="modal fade" id="modalBukuEdit{{ $bk->id_buku }}" tabindex="-1" role="dialog" aria-labelledby="modalBukuEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalBukuEditLabel">Form Edit Data Buku</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/buku/edit/{{ $bk->id_buku }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            
                                            <div class="form-group row">
                                                <label for="kode_buku" class="col-sm-4 col-form-label">Kode Buku</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="{{ $bk->kode_buku }}" placeholder="Masukan Kode Buku">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="judul" class="col-sm-4 col-form-label">Judul Buku</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $bk->judul }}" placeholder="Masukan Judul Buku">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pengarang" class="col-sm-4 col-form-label">Nama Pengarang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $bk->pengarang }}" placeholder="Masukan Nama Pengarang">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $bk->kategori }}" placeholder="Masukan Kategori">
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
                        <!-- End Modal Edit Data Buku -->
                        
                        <a href="buku/hapus/{{$bk->id_buku}}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        Halaman: {{ $buku->currentPage() }} <br />
        Jumlah Data: {{ $buku->total() }} <br />
        Data Per Halaman: {{ $buku->perPage() }} <br />
        {{ $buku->links() }}
    </div>

    <!-- Modal Tambah Data Buku -->
    <div class="modal fade" id="modalBukuTambah" tabindex="-1" role="dialog" aria-labelledby="modalBukuTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBukuTambahLabel">Form Input Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/buku/tambah" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="kode_buku" class="col-sm-4 col-form-label">Kode Buku</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Masukan Kode Buku">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="judul" class="col-sm-4 col-form-label">Judul Buku</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul Buku">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pengarang" class="col-sm-4 col-form-label">Nama Pengarang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukan Nama Pengarang">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Data Buku -->
@endsection
