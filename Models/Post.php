<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'db_jajan';
    // jika tablenya beda 

    protected $fillable = ['image', 'caption', 'user_id'];
    // boleh diisi

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); 

    }
    // relasi antar table 

    public function getImageAttribute($value) {
        return url("post_image/$value"); 

    }
    // jadi url akan lengkap, bukan hanya nama & jenisnya saja
    
}
