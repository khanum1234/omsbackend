<?php

namespace App\Domain\StudentRegistr\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class StudentRegistrationDTO extends Data
{
    public function __construct(
    public string $name,
    public ?string $registeration_date,
    ){}

    public static function fromRequest($request)
    {
        return new self(
            $request['name'] ?? null,
            $request['registeration_date'] ?? null,

        );
    }


}
