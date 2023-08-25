<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen_Danhmuc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['danhmuc_id', 'theloai_id'];
    protected $primaryKey = 'id';
    protected $table = 'truyen_danhmuc';

}
