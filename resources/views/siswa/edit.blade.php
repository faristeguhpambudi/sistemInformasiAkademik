@extends('layout/master')

@section('title', 'Edit Data Siswa')

@section('kontenUtama')
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow mt-3">
                    <div class="card-header bg-transparent border-0">
                        <h2 class="text-warning mb-0">Form Edit Data Siswa</h2>
                      </div>
                      <div class="card-body text-white">
                        <form action="/siswa/{{ $siswa->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                              <label for="nama_depan" class="col-sm-2 col-form-label">Nama Depan</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_depan" name="nama_depan" placeholder="masukkan nama depan..." value="{{ $siswa->nama_depan }}">
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_belakang" class="col-sm-2 col-form-label">Nama Belakang</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" placeholder="masukkan nama belakang..." value="{{ $siswa->nama_belakang }}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                  <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                                  <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="agama" name="agama">
                                  <option value="Islam" @if ($siswa->agama == 'Islam') selected @endif>Islam</option>
                                  <option value="Kristen" @if ($siswa->agama == 'Kristen') selected @endif>Kristen</option>
                                  <option value="Hindhu" @if ($siswa->agama == 'Hindu') selected @endif>Hindhu</option>
                                  <option value="Buddha" @if ($siswa->agama == 'Buddha') selected @endif>Buddha</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $siswa->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">

                                </div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info"><b>Update</b></button>
                                </div>
                            </div>
                          </form>
                      </div>
                </div>
            </div>
        </div>
@endsection
