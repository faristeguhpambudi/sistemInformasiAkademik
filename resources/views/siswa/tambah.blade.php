@extends('layout/master')

@section('title', 'Tambah Data Siswa')

@section('kontenUtama')
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow mt-3">
                    <div class="card-header bg-transparent border-0">
                        <h2 class="text-warning mb-0">Form Tambah Data Siswa</h2>
                      </div>
                      <div class="card-body text-white">
                        <form action="/siswa/store" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group row">
                              <label for="nama_depan" class="col-sm-2 col-form-label">Nama Depan</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_depan" name="nama_depan" placeholder="masukkan nama depan..." value="{{ old('nama_depan') }}">
                                @error('nama_depan')
                                  <div class="alert alert-info bg-danger text-white">{{ $message }}</div>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_belakang" class="col-sm-2 col-form-label">Nama Belakang</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name="nama_belakang" placeholder="masukkan nama belakang..." value="{{ old('nama_belakang') }}">
                                  @error('nama_belakang')
                                      <div class="alert alert-info bg-danger text-white">{{ $message }}</div>
                                  @enderror
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control @error('nama_belakang') is-invalid @enderror" id="email" name="email" placeholder="masukkan email..." value="{{ old('email') }}">
                                  @error('email')
                                      <div class="alert alert-info bg-danger text-white">{{ $message }}</div>
                                  @enderror
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                  <option value="L">Laki-laki</option>
                                  <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                  <option value="Islam">Islam</option>
                                  <option value="Kristen">Kristen</option>
                                  <option value="Hindhu">Hindhu</option>
                                  <option value="Buddha">Buddha</option>
                                </select>
                                </div>
                                @error('agama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="alert alert-info bg-danger text-white">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">

                                </div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info"><b>Tambah</b></button>
                                </div>
                            </div>
                          </form>
                      </div>
                </div>
            </div>
        </div>
@endsection
