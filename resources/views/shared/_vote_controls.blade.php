<a title="This {{ $text }} is useful"
   class="upvote @guest {{ 'off' }} @endguest"
   onclick="event.preventDefault(); document.getElementById('upvote-{{ $text . "-" . $model->id }}').submit();"
>
    <i class="fas fa-caret-up fa-3x"></i>
</a>
<form id="upvote-{{ $text . "-" . $model->id }}"
      action="{{ route($route_name, $model->id) }}"
      method="post"
      style="display:none;">
    @csrf
    @method('PATCH')
    <input type="number" name="vote" value="1" hidden>
</form>

<span class="votes-count">{{ $model->votes_count }}</span>

<a title="This {{ $text }} is not useful"
   class="downvote @guest {{ 'off' }} @endguest"
   onclick="event.preventDefault(); document.getElementById('downvote-{{ $text . "-" . $model->id }}').submit();"
>
    <i class="fas fa-caret-down fa-3x"></i>
</a>
<form id="downvote-{{ $text . "-" . $model->id }}"
      action="{{ route($route_name, $model->id) }}"
      method="post"
      style="display:none;">
    @csrf
    @method('PATCH')
    <input type="number" name="vote" value="-1" hidden>
</form>

@includeWhen($model instanceof \App\Question, 'shared._favourite-question-control', ['question' => $model])

@includeWhen($model instanceof \App\Answer, 'shared._accepted-answer-control', ['answer' => $model])

