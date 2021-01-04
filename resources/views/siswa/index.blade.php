@extends('layout/master')

@section('title', 'Data Siswa')

@section('kontenUtama')
        <div class="row">
            <div class="col-lg-6">
                <a href="/siswa/create" class="btn btn-primary mb-3">
                    Tambah Data Siswa
                </a>
            </div>
            <div class="col-lg-6">
                <form action="/siswa" method="get" class="mb-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="masukkan kata kunci.." name="cari">
                        <div class="input-group-append">
                        <button class="btn btn-success" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                @if (session('pesan'))
                    <div class="alert alert-success bg-success text-white">
                        {{ session('pesan') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
              <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                  <h2 class="text-warning mb-0">Data Siswa</h2>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col" class="sort text-white"><b>No</b></th>
                        <th scope="col" class="sort text-white"><b>Nama Depan</b></th>
                        <th scope="col" class="sort text-white"><b>Nama Belakang</b></th>
                        <th scope="col" class="sort text-white"><b>Jenis Kelamin</b></th>
                        <th scope="col" class="sort text-white"><b>Agama</b></th>
                        <th scope="col" class="sort text-white"><b>Alamat</b></th>
                        <th scope="col" class="sort text-white"><b>Aksi</b></th>
                      </tr>
                    </thead>
                    <tbody class="list">
                        <?php $i=1; ?>
                        @foreach ($data_siswa as $ds)
                        <tr>
                            <th class="text-center">{{ $i }}</th>
                            <td>{{ $ds->nama_depan }}</td>
                            <td>{{ $ds->nama_belakang }}</td>
                            <td class="text-center">{{ $ds->jenis_kelamin }}</td>
                            <td>{{ $ds->agama }}</td>
                            <td>{{ $ds->alamat }}</td>
                            <td class="text-center">
                                <a href="/siswa/{{ $ds->id }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="/siswa/{{ $ds->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <form action="/siswa/{{ $ds->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Delete</button>
                                </form>
                            </td>
                            <?php $i++; ?>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

        </div>
@endsection
