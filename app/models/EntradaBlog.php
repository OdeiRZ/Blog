<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntradaBlog extends Model {
    protected $table = 'blog_entradas';
    protected $fillable = ['titulo', 'contenido', 'imagen'];
}