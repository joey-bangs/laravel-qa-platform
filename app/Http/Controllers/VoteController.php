<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return RedirectResponse
     */
    public function voteQuestion(Request $request, Question $question)
    {
        Auth::user()->voteQuestion($question, $request->vote);

        return back();
    }

    /**
     * @param Request $request
     * @param Answer $answer
     * @return RedirectResponse
     */
    public function voteAnswer(Request $request, Answer $answer)
    {
        Auth::user()->voteAnswer($answer, $request->vote);

        return back();
    }
}
