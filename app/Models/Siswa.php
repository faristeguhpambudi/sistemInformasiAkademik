<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    //Setting custom tabel ATAU timpa default tabel database
    protected $table = 'siswa';
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'agama',
        'alamat',
        'foto',
        'user_id'
    ];

    public function getFoto()
    {
        if(!$this->foto)
        {
            return asset('image/default.jpg');
        }
        return asset('image/' . $this->foto );
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimestamps();
    }
}
