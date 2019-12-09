<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>
                        {{ $question->answers_count . " " .  \Illuminate\Support\Str::plural('answers', $question->answers_count)  }}
                    </h2>
                </div>

                <hr>

                @include('layouts._alerts')

                @foreach($question->answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" href="" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a title="This answer is not useful" href=""
                               class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as accepted answer (Click again to undo)"
                               href="" class="{{  $answer->status }} mt-2">
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                        </div>

                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-md-4">
                                    @can('update', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                           class="btn btn-sm btn-outline-info">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $answer)
                                        <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                              class="delete-form" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="alert('Delete?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                        <span class="text-muted">
                                            Answered {{ $answer->created_at->diffForHumans() }}
                                        </span>

                                    <div class="media mt-4">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}"
                                                 alt="{{ $answer->user->name . "'s avatar" }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">
                                                {{ $answer->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
