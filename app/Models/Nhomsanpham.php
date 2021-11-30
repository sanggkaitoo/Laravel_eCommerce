<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhomsanpham extends Model
{
    use HasFactory;
    protected $table='nhomsanpham';
    protected $fillable=['ten', 'trangthai', 'uutien'];

    public function sanphams(){
        return $this->hasMany(Sanpham::class, 'nhomsanphamid','id');
    }
}
