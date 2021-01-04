<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('cari'))
        {
            $data_siswa = Siswa::where('nama_depan', 'LIKE','%'.$request->cari.'%')->get();
        } else {
            //MENAMPILKAN SEMUA DATA SISWA
            //mengambil data dari database
            $data_siswa = Siswa::all();
        }
        return view('siswa/index', ['data_siswa' => $data_siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan halaman form tambah
        return view('siswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDASI FORM
        $request->validate([
            'nama_depan' => 'required|min:2',
            'nama_belakang' => 'required',
            'email' => 'required|unique:users',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        //UNTUK MENYIMPAN KE DATABASE
        //INSERT KE TABLE USER
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('sukses');
        $user->remember_token = Str::random(60);
        $user->save();

        //INSERT KE TABLE SISWA

        Siswa::create([
            'user_id' => $user->id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'foto' => 'default.jpg',
        ]);


        //redirect dengan pesan
        return redirect('/siswa')->with('pesan', 'Data Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $matapelajaran = Mapel::all();
        return view('siswa/detail', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //UNTUK HALAMAN EDIT DATA
        //ambil data berdasarkan id
        //buka halaman edit kirim data yang ingin diedit
        return view('siswa/edit', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //UNTUK UPDATE DATABASE
        Siswa::find($siswa); //Cari siswa yang ingin diupdate
        $siswa->nama_depan = $request->nama_depan;
        $siswa->nama_belakang = $request->nama_belakang;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->agama = $request->agama;
        $siswa->alamat = $request->alamat;
        $siswa->save();

        //cek ada kirim file atau tidak
        if($request->hasFile('foto'))
        {
            //ambil nama file untuk ke database
            $namaFoto = $request->foto->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            //untuk upload file ke folder image
            $request->foto->move(public_path('image'), $namaFoto);
            //simpan nama ke database
            $siswa->foto = $namaFoto;
            $siswa->save();
        }
        //redirect dengan pesan
        return redirect('/siswa')->with('pesan', 'Data Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //HAPUS DATA
        Siswa::destroy($siswa->id);
        //redirect dengan pesan
        return redirect('/siswa')->with('pesan', 'Data Berhasil dihapus!');
    }

    public function add_nilai(Request $request, Siswa $siswa)
    {
        Siswa::find($siswa);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists())
        {
            return redirect('/siswa/' . $siswa->id)->with('pesanError', 'Gagal Memasukkan Nilai, Nilai Mata Pelajaran ini sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        //redirect dengan pesan
        return redirect('/siswa/' . $siswa->id)->with('pesan', 'Nilai Berhasil dimasukkan!');
    }
}
