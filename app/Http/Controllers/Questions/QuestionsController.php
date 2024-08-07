<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    
    // عرض الأسئلة المرتبطة بدرس معين
    public function show($lessonId)
    {
        $questions = Questions::where('lessons_id', $lessonId)->get();
        return view('questions.show', compact('questions'));
    }

    // إضافة سؤال جديد
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required',
            'lesson_id' => 'required|exists:lessons,id',
            'options' => 'required|json',
            'correct_answer' => 'required',
        ]);

        Questions::create($request->all());

        return redirect()->back()->with('success', 'تم إضافة السؤال بنجاح');
    }
}

