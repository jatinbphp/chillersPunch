<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['competitionId', 'submissionTitle', 'fullName', 'phoneNumber', 'emailAddress', 'videoFile', 'status', 'isWinner'];

    public function votings(){
        return $this->hasMany(Voting::class, 'submissionId'); // Adjust the relationship as per your schema
    }
}