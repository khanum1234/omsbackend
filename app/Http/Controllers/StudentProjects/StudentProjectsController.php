<?php

namespace App\Http\Controllers;
use App\Domain\StudentProjects\Actions\CreateStudentProjects;
use App\Domain\StudentProjects\DTO\StudentProjectsDTO;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\StudentProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CreateStudentProjects = StudentProjects::all();
        return response()->json(Response::success($CreateStudentProjects->toArray()),200);
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
            
            'description' => ['string'],
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $StudentProjectsDTO = StudentProjectsDTO::fromRequest($request->all());
        $StudentProjects = CreateStudentProjects::execute($StudentProjectsDTO);
        return response()->json(Response::success($StudentProjects->toArray()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

    }

}
