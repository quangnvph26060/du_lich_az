<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogue extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'catalogues';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
