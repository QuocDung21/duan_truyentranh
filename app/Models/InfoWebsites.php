<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoWebsites extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'contact',
        'website_info',
        'logo'
    ];
    protected $primaryKey = 'id';
    protected $table = 'info_websites';
}
