<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = ['question_text', 'lesson_id', 'options', 'correct_answer'];
    public function Answers(){
        return $this->hasMany(answers::class);
    }  
}
