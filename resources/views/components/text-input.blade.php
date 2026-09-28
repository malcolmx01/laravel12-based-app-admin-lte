{{--
    Text-like <input class="form-control">. Reads validation state for its `name`
    from the given error bag and, when invalid, adds is-invalid, aria-invalid and
    "<id>-error" to aria-describedby (pair it with <x-input-error for="<id>">).
    When the bag has errors, only the first invalid field keeps/gets autofocus.
--}}
@props(['disabled' => false, 'bag' => 'default'])

@php
    $field = $attributes->get('name');
    $id = $attributes->get('id', $field);
    $bagErrors = $errors->getBag($bag);
    $invalid = $field && $bagErrors->has($field);
    $describedBy = trim($attributes->get('aria-describedby', '').($invalid ? ' '.$id.'-error' : ''));
    $autofocus = $bagErrors->any() ? ($bagErrors->keys()[0] ?? null) === $field : $attributes->has('autofocus');
@endphp

<input @disabled($disabled) {{ $attributes->except(['aria-describedby', 'autofocus'])->class(['form-control', 'is-invalid' => $invalid]) }}
    @if ($invalid) aria-invalid="true" @endif
    @if ($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
    @if ($autofocus) autofocus @endif>
