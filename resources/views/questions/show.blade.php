@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex justify-content-between">
                                <h3>{{ $question->title }}</h3>
                                <a href="{{ route('questions.index') }}"
                                   class="btn btn-outline-secondary">
                                    Go back to questions
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful"
                                   class="upvote @guest {{ 'off' }} @endguest"
                                   onclick="event.preventDefault(); document.getElementById('upvote-question-{{ $question->id }}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form id="upvote-question-{{ $question->id }}"
                                      action="{{ route('vote.question', $question->id) }}"
                                      method="post"
                                      style="display:none;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="vote" value="1" hidden>
                                </form>
                                <span class="votes-count">{{ $question->votes_count }}</span>
                                <a title="This question is not useful"
                                   class="downvote @guest {{ 'off' }} @endguest"
                                   onclick="event.preventDefault(); document.getElementById('downvote-question-{{ $question->id }}').submit();"
                                >
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form id="downvote-question-{{ $question->id }}"
                                      action="{{ route('vote.question', $question->id) }}"
                                      method="post"
                                      style="display:none;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="vote" value="-1" hidden>
                                </form>

                                <a title="Click to mark as favourite question (Click again to undo)"
                                   class="favourite @guest {{ 'off' }} @else {{ $question->isFavoured ? 'favoured' : '' }} @endguest mt-2"
                                   onclick="event.preventDefault(); document.getElementById('favourite-question-{{ $question->id }}').submit();">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favourites-count">
                                        {{ $question->favourites->count() }}
                                    </span>
                                </a>
                                <form id="favourite-question-{{ $question->id }}"
                                      action="{{ route('questions.toggleFavourite', $question->id) }}"
                                      method="post"
                                      style="display:none;">
                                    @csrf
                                    @method('PATCH')
                                </form>
                            </div>

                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                            <span class="text-muted">
                                Asked {{ $question->created_at->diffForHumans() }}
                            </span>

                                    <div class="media mt-4">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}"
                                                 alt="{{ $question->user->name . "'s avatar" }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">
                                                {{ $question->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('answers._index', ['question' => $question])

        @include('answers._form')
    </div>
@endsection
