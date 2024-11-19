<div class="progress">
    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
         aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%;">
        <span class="sr-only">{{ $percentage }}% Complete (success)</span>
    </div>
</div>
<span>{{ $percentage }}%</span>
