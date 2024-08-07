<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'question_id', 'answer'];
    public function Questions(){
        return $this->belongsTo(questions::class);
    }  
}
