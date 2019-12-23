@if($question->answers_count > 0)
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
                        <answer-view :answer="{{$answer}}"></answer-view>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
