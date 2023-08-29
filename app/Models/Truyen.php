<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Theloai;
use App\Models\DanhmucTruyen;

class Truyen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['tentruyen', 'tacgia', 'tomtat', 'slug_truyen', 'danhmuc_id', 'hinhanh', 'kichhoat', 'luotxem', 'tag'];
    protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function danhmuctruyen()
    {
        return $this->belongsTo('App\Models\DanhmucTruyen', 'danhmuc_id', 'id');
    }

    public function chapter()
    {
        return $this->hasMany('App\Models\Chapter', 'truyen_id', 'id');
    }

    public function theloai()
    {
        return $this->belongsTo('App\Models\Theloai', 'theloai_id', 'id');
    }
    public function thuocnhieutheloaitruyen()
    {
        return $this->belongsToMany(Theloai::class, 'truyen_theloai', 'truyen_id', 'theloai_id');
    }

    public function thuocnhieudanhmuctruyen()
    {
        return $this->belongsToMany(DanhmucTruyen::class, 'truyen_danhmuc', 'truyen_id', 'danhmuc_id');
    }
}
