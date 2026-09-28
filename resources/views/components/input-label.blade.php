{{-- Form label. `required` adds the visual asterisk plus a screen-reader "(required)". --}}
@props(['value' => null, 'required' => false])

<label {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $value ?? $slot }}@if ($required) <span class="text-danger-emphasis" aria-hidden="true">*</span><span class="visually-hidden">(required)</span>@endif
</label>
