<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\Lessons;
use Illuminate\Support\Facades\Validator;
use App\Domain\Lesson\Actions\CreateLessonAction;
use App\Domain\Lesson\DTO\LessonDTO;

class LessonsController extends Controller
{    /**
    * Display a listing of the resource.
    */
   public function index()
   {
       $categories = Lessons::all();
       return response()->json(Response::success($categories->toArray()),200);
   }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
            'description' => ['nullable','string'],
            'type' => ['string','nullable']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $lessonDTO = LessonDTO::fromRequest($request->all());
        $lesson = CreateLessonAction::execute($lessonDTO);
        return response()->json(Response::success($lesson->toArray()),200);
    }
}
