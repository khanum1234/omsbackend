<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\Validator;
use App\Domain\StudentRegistr\Actions\CreateStudentRegistration;
use App\Domain\StudentRegistr\DTO\StudentRegistrationDTO;
use App\Domain\StudentRegistr\Actions\UpdateStudendRegistration;


class StudentRegistrationController extends Controller
{

      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Student_Registar =StudentRegistration::all();
        return response()->json(Response::success($Student_Registar->toArray()),200);
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        
            'registeration_date' => ['date']
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $Student_RegistarDTO = StudentRegistrationDTO::fromRequest($request->all());
        $Student_Registar = CreateStudentRegistration::execute($Student_RegistarDTO);
        return response()->json(Response::success($Student_Registar->toArray()),200);
    }


    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'registeration_date' => ['date']

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $Student_RegistarDTO = StudentRegistrationDTO::fromRequest($request->all());
        $Student_Registar = StudentRegistration::query()->find($id);
        if (!$Student_Registar) {
            return response()->json([
                'success' => false,
                'message' => 'Student_Registar not found',
                    ], 404);
                }
        $Student_Registar = UpdateStudendRegistration::execute($Student_Registar,$Student_RegistarDTO);
        return response()->json(Response::success($Student_Registar->toArray()),200);
    }


      /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $Student_Registar = StudentRegistration::query()->find($id);
        if (!$Student_Registar) {
            return response()->json([
                'success' => false,
                'message' => 'Student_Registar not found',
                    ], 404);
                }
        $Student_Registar->delete();
        return response()->json(Response::success($Student_Registar->toArray()),200);
    }
}
