{{--
    Inline field error. Place it right after its control (Bootstrap shows
    .invalid-feedback for a preceding .is-invalid sibling); outside that
    position (e.g. under a fieldset) add class="d-block". `for` = the control's
    id, giving the message id "<for>-error" for aria-describedby.
--}}
@props(['messages', 'for' => null])

@if ($messages)
    <div @if ($for) id="{{ $for }}-error" @endif {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}@unless ($loop->last)<br>@endunless
        @endforeach
    </div>
@endif
