<span class="text-muted">{{ $text . " " . $model->created_at->diffForHumans() }}</span>

<div class="media mt-4">
    <a href="{{ $model->user->url }}" class="pr-2">
        <img src="{{ $model->user->avatar }}"
             alt="{{ $model->user->name . "'s avatar" }}">
    </a>
    <div class="media-body mt-1">
        <a href="{{ $model->user->url }}">
            {{ $model->user->name }}
        </a>
    </div>
</div>
