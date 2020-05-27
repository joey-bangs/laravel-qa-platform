<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Question;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Traits\FileUploadable;

class QuestionController extends Controller
{
    use FileUploadable;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|Response|View
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(10);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQuestion $request
     * @return RedirectResponse|Response
     */
    public function store(StoreQuestion $request)
    {
        $new_question_data = $request->validated();

        $file_url = $this->handleUpload($request, 'questions');

        if ($file_url) {
            $new_file_url = str_replace('public/', '', $file_url);
            $new_question_data['file_url'] = $new_file_url;
        }

        $request->user()->questions()->create($new_question_data);

        return redirect()
            ->route('questions.index')
            ->with('success', 'Your question has been submitted.');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return Factory|Response|View
     */
    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return Factory|Response|View
     * @throws AuthorizationException
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreQuestion $request
     * @param Question $question
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(StoreQuestion $request, Question $question)
    {
        $this->authorize('update', $question);

        $update_question_data = $request->validated();

        $file_url = $this->handleUpload($request, 'questions');

        if ($file_url) {
            $new_file_url = str_replace('public/', '', $file_url);
            $update_question_data['file_url'] = $new_file_url;
        }


        $question->update($update_question_data);

        return redirect()
            ->route('questions.index')
            ->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);

        $question->delete();

        return redirect()
            ->route('questions.index')
            ->with('success', 'Your question has been deleted.');
    }


    /**
     * Toggle favouring question.
     *
     * @param Question $question
     * @return JsonResponse|RedirectResponse|Response
     */
    public function toggleFavourite(Question $question)
    {
        $question->toggleFavourite();

        if (request()->wantsJson()) {
            return response()->json(['question' => $question]);
        }

        return back();
    }
}
