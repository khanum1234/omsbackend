<?php

namespace App\Domain\StudentRegistr\Actions;

use App\Domain\StudentRegistr\DTO\StudentRegistrationDTO;
use App\Models\StudentRegistration;

use Spatie\LaravelData\Data;

class UpdateStudendRegistration extends Data
{
    public static function execute(StudentRegistration $Student_Registar,StudentRegistrationDTO $DTO){
        $Student_Registar->update($DTO->toArray());
        return $Student_Registar;
    }

}
