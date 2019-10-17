@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Question</h3>
                        <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">
                            Ask question
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._alerts')

                    @foreach ($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="votes">
                                <strong>{{ $question->votes }}</strong>
                                {{ \Str::plural('vote', $question->votes) }}
                            </div>
                            <div class="answers status {{ $question->status }}">
                                <strong>{{ $question->answers }}</strong>
                                {{ \Str::plural('answer', $question->answers) }}
                            </div>
                            <div class="views">
                                {{ $question->views . " " . \Str::plural('view', $question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="mt-0">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                </h3>
                                <div>
                                    @can('update', $question)
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $question)
                                        <form action="{{ route('questions.destroy', $question->id) }}" class="delete-form" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="alert('Delete?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                            <p class="lead">
                                <a href="{{ $question->user->url }}" >
                                    {{ $question->user->name }}
                                </a>
                                <small class="text-mute">
                                    {{ $question->created_at->diffForHumans() }}
                                </small>
                            </p>
                            {{ \Illuminate\Support\Str::limit($question->body, 250) }}
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    <div class="d-flex justify-content-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
