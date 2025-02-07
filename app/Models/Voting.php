<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $fillable = ['competitionId', 'submissionId', 'ipAdress'];

    public function submission(){
        return $this->belongsTo(Submission::class, 'submissionId');
    }
}
