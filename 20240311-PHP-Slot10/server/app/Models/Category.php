<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_users');
    }

}
