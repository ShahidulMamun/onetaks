{{-- resources/views/user/submit_job/partials/slideshow.blade.php --}}
{{-- Variables: $items (Collection), $field (string), $id (string) --}}

@php
    $allSrcs = $items->map(fn($s) => asset('storage/'.$s->{$field}))->toJson();
@endphp

<div class="slideshow-wrap">
    <!-- Stage -->
    <div class="slide-stage" id="slideshow-{{ $id }}">
        <span class="slide-counter" id="counter-{{ $id }}">1 / {{ $items->count() }}</span>

        @foreach($items as $idx => $sub)
            @php $src = asset('storage/'.$sub->{$field}); @endphp
            <div class="slide-item {{ $idx === 0 ? 'active' : '' }}">
                <img src="{{ $src }}"
                     alt="Proof #{{ $idx + 1 }}"
                     onclick="openLightbox('{{ $src }}', {!! $allSrcs !!}, {{ $idx }})"
                     title="Click to enlarge">
            </div>
        @endforeach

        @if($items->count() > 1)
            <button class="slide-nav prev" id="prev-{{ $id }}"><i class="bi bi-chevron-left"></i></button>
            <button class="slide-nav next" id="next-{{ $id }}"><i class="bi bi-chevron-right"></i></button>
        @endif
    </div>

    <!-- Dots -->
    @if($items->count() > 1)
    <div class="slide-dots" id="dots-{{ $id }}">
        @foreach($items as $idx => $sub)
            <button class="slide-dot {{ $idx === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    @endif

    <!-- Thumbnail Strip -->
    @if($items->count() > 1)
    <div class="thumb-strip" id="thumbs-{{ $id }}">
        @foreach($items as $idx => $sub)
            <div class="thumb-item {{ $idx === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/'.$sub->{$field}) }}" alt="thumb {{ $idx + 1 }}">
            </div>
        @endforeach
    </div>
    @endif
</div>