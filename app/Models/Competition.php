<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Competition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','description','image','status'];

    public function submissions(){
        return $this->hasMany(Submission::class, 'competitionId');
    }

    public function votings(){
        return $this->hasMany(Voting::class, 'competitionId'); // Adjust the relationship as per your schema
    }
}
