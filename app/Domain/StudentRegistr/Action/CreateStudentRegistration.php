<?php

namespace App\Domain\StudentRegistr\Actions;

use App\Domain\StudentRegistr\DTO\StudentRegistrationDTO;
use App\Models\StudentRegistration;
use Spatie\LaravelData\Data;
use  App\Models\transactions;
use App\Models\Course;


class CreateStudentRegistration extends Data
{
    public static function execute(StudentRegistrationDTO $DTO){
        $Student_Registar = new StudentRegistration($DTO->toArray());
        $transactions=new transactions();
        $coursses=new Course();
        if( $transactions->amount >= $coursses->price )
        {
        $Student_Registar->save();
        
        return $Student_Registar;

        }
        else {
            return ("no many");

        }
    }

}
