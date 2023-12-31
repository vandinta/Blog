<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'tb_blog';

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'image',
    ];
}
