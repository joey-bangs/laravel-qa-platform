<a title="Click to mark as favourite question (Click again to undo)"
   class="favourite @guest {{ 'off' }} @else {{ $question->isFavoured ? 'favoured' : '' }} @endguest mt-2"
   onclick="event.preventDefault(); document.getElementById('favourite-question-{{ $question->id }}').submit();">
    <i class="fas fa-star fa-2x"></i>
    <span class="favourites-count">{{ $question->favourites->count() }}</span>
</a>
<form id="favourite-question-{{ $question->id }}"
      action="{{ route('questions.toggleFavourite', $question->id) }}"
      method="post"
      style="display:none;">
    @csrf
    @method('PATCH')
</form>
