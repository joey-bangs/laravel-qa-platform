@can('accept', $answer)
    <a title="Click to mark as accepted answer (Click again to undo)"
       class="{{  $answer->status }} mt-2"
       onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
        <i class="fas fa-check fa-2x"></i>
    </a>

    <form id="accept-answer-{{ $answer->id }}"
          action="{{ route('answers.accept', $answer->id) }}"
          method="post"
          style="display:none;">
        @csrf
    </form>
@endcan

@cannot('accept', $answer)
    @if($answer->is_best)
        <a title="The question owner marked this answer as accepted answer"
           class="{{  $answer->status }} mt-2"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcannot
