@extends('layout/master')

@section('title', 'Data Siswa')

@section('kontenUtama')
        <div class="row">
            <div class="col-lg-6">
                @if (session('pesan'))
                    <div class="alert alert-info bg-success text-white">
                        {{ session('pesan') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @if (session('pesanError'))
                    <div class="alert alert-info bg-danger text-white">
                        {{ session('pesanError') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
              <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                  <h2 class="text-warning mb-0">Detail Profil Siswa</h2>
                </div>
                <div class="card-body bg-default shadow">
                    <div class="row">
                        <div class="col-sm-4 float-right">
                            <img src="{{ $siswa->getFoto() }}" class="rounded" width="200px">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="card-title">Nama : {{ $siswa->nama_depan . ' ' . $siswa->nama_belakang }}</h5>
                            <p class="card-text">Jenis Kelamin : {{ $siswa->jenis_kelamin }}</p>
                            <p class="card-text">Agama : {{ $siswa->agama }}</p>
                            <p class="card-text">Alamat : {{ $siswa->alamat }}</p>
                            <p class="card-text">Jumlah mata pelajaran : {{ $siswa->mapel->count() }}</p>
                            <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-danger">Edit Data</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
              <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                  <h2 class="text-warning mb-2">Data Nilai</h2>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahNilai">
                    Tambah Nilai
                  </button>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col" class="sort text-white"><b>No</b></th>
                        <th scope="col" class="sort text-white"><b>Kode</b></th>
                        <th scope="col" class="sort text-white"><b>Mata Pelajaran</b></th>
                        <th scope="col" class="sort text-white"><b>Semester</b></th>
                        <th scope="col" class="sort text-white"><b>Nilai</b></th>
                      </tr>
                    </thead>
                    <tbody class="list">
                        <?php $i=1; ?>
                        @foreach ($siswa->mapel as $mapel)
                        <tr>
                            <th class="text-center">{{ $i }}</th>
                            <td>{{ $mapel->kode }}</td>
                            <td>{{ $mapel->nama }}</td>
                            <td class="text-center">{{ $mapel->semester }}</td>
                            <td class="text-center">{{ $mapel->pivot->nilai }}</td>
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


  <!-- Modal -->
  <div class="modal fade" id="tambahNilai" tabindex="-1" role="dialog" aria-labelledby="tambahNilaiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-dark">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="tambahNilaiLabel">Form Tambah Nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/siswa/{{ $siswa->id }}/add_nilai" method="post">
                @csrf
                @method('post')
                <div class="form-group row text-white">
                    <label for="mapel" class="col-sm-2 col-form-label text-white">Mapel</label>
                    <div class="col-sm-10">
                    <select class="form-control @error('mapel') is-invalid @enderror" id="mapel" name="mapel">
                        @foreach ($matapelajaran as $mp)
                            <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <div class="alert alert-danger bg-danger text-white">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row text-white">
                  <label for="nilai" class="col-sm-2 col-form-label text-white">Nilai</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" placeholder="masukkan nilai..." value="{{ old('nilai') }}">
                    @error('nilai')
                      <div class="alert alert-info bg-danger text-white">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
