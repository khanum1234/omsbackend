<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Attendances;
use App\Models\Questions;
use Illuminate\Http\Request;

class AnswersController extends Controller
{


// في ملف المتحكم

    // تسجيل الإجابات
    public function store(Request $request)
    {
        $correctAnswers = 0;
        $totalQuestions = count($request->answers);

        foreach ($request->answers as $questionId => $answer) {
            $question = Questions::find($questionId);
            if ($question->correct_answer == $answer) {
                $correctAnswers++;
            }

            Answers::create([
                'student_id' => auth()->id(),
                'question_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        // تحديد نسبة النجاح
        $attendanceThreshold = 0.7; // نسبة النجاح المطلوبة
        $attended = ($correctAnswers / $totalQuestions) >= $attendanceThreshold;

        // تسجيل الحضور
        Attendances::create([
            'student_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'attended' => $attended,
        ]);

        return redirect()->back()->with('success', 'تم تسجيل إجاباتك بنجاح');
    }
}
