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
                                <a title="This question is useful" href="" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1293</span>
                                <a title="This question is not useful" href=""
                                   class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Click to mark as favourite question (Click again to undo)"
                                   href="" class="favourite mt-2">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favourites-count">123</span>
                                </a>
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
