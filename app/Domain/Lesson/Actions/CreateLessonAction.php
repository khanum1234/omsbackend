<?php

namespace App\Domain\Lesson\Actions;

use App\Domain\Lesson\DTO\LessonDTO;
use App\Models\Lessons;
use Spatie\LaravelData\Data;

class CreateLessonAction extends Data
{
    public static function execute(LessonDTO $DTO){
        $lesson = new Lessons($DTO->toArray());
         $lesson->save();
        return  $lesson;
    }

}
