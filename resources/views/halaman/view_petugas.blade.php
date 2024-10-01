@extends('index')
@section('title', 'Petugas')

@section('isihalaman')
    <h3 class="text-center">Daftar Petugas Perpustakaan Universitas Semarang</h3>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPetugasTambah"> 
        Tambah Data Petugas 
    </button>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th align="center">No</th>
                <th align="center">ID Petugas</th>
                <th align="center">Nama Petugas</th>
                <th align="center">HP</th>
                <th align="center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($petugas as $index => $p)
                <tr>
                    <td align="center" scope="row">{{ $index + $petugas->firstItem() }}</td>
                    <td>{{ $p->id_petugas }}</td>
                    <td>{{ $p->nama_petugas }}</td>
                    <td>{{ $p->hp }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalPetugasEdit{{ $p->id_petugas }}"> 
                            Edit
                        </button>

                        <!-- Modal Edit Data Petugas -->
                        <div class="modal fade" id="modalPetugasEdit{{ $p->id_petugas }}" tabindex="-1" role="dialog" aria-labelledby="modalPetugasEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPetugasEditLabel">Form Edit Data Petugas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/petugas/edit/{{ $p->id_petugas }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            
                                            <div class="form-group row">
                                                <label for="nama_petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="{{ $p->nama_petugas }}" placeholder="Masukkan Nama Petugas">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hp" class="col-sm-4 col-form-label">HP</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="hp" name="hp" value="{{ $p->hp }}" placeholder="Masukkan HP">
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
                        <!-- End Modal Edit Data Petugas -->

                        <a href="petugas/hapus/{{$p->id_petugas}}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        Halaman: {{ $petugas->currentPage() }} <br />
        Jumlah Data: {{ $petugas->total() }} <br />
        Data Per Halaman: {{ $petugas->perPage() }} <br />
        {{ $petugas->links() }}
    </div>

    <!-- Modal Tambah Data Petugas -->
    <div class="modal fade" id="modalPetugasTambah" tabindex="-1" role="dialog" aria-labelledby="modalPetugasTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPetugasTambahLabel">Form Input Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/petugas/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Masukkan Nama Petugas">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hp" class="col-sm-4 col-form-label">HP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="hp" name="hp" placeholder="Masukkan HP">
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
    <!-- End Modal Tambah Data Petugas -->
@endsection
