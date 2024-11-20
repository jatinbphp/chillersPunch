<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonPages extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','description'];
}
