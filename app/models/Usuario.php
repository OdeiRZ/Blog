<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'blog_usuarios';
    protected $fillable = ['nombre', 'email', 'password'];
}
