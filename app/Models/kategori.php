<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk; 

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = ['nama'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
