<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen_Theloai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['theloai_id', 'truyen_id'];
    protected $primaryKey = 'id';
    protected $table = 'truyen_theloai';
}
