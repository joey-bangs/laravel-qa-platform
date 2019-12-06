<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param Request $request
     * @return Response
     */
    public function store(Question $question, Request $request)
    {
        $question->answers()->create(
            $request->validate(['body' => 'required']) + ['user_id' => Auth::id()]
        );

        return back()->with('success', 'Your answer has been submitted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Answer $answer
     * @return Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Answer $answer
     * @return Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
