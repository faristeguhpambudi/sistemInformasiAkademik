@extends('layout/masterlogin')

@section('title', 'Halaman login')

@section('kontenUtama')
<div class="row">
    <div class="col-lg-9">
        <div class="card bg-default shadow mt-3">
            <div class="card-header bg-transparent border-0">
                <h2 class="text-warning mb-0 text-center">Form Login Aplikasi</h2>
              </div>
              <div class="card-body text-white">
                <form action="/auth/login" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="masukkan email anda...">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password anda...">
                        </div>
                      </div>
                    <div class="form-group row">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-10 float-right">
                            <button type="submit" class="btn btn-info text-dark floa"><b>Login</b></button>
                        </div>
                    </div>
                  </form>
              </div>
        </div>
    </div>
</div>
@endsection
