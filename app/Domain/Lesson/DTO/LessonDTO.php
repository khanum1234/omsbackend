<?php

namespace App\Domain\Lesson\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class LessonDTO extends Data
{
    public function __construct(
    public string $name,
    public ?string $file,
    public ?string $description,
    ){}

    public static function fromRequest($request)
    {
        return new self(
            $request['name'] ?? null,
            $request['file'] ?? null,
            $request['description'] ?? null,

        );
    }


}
