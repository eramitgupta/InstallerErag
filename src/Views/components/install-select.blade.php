@props(['label', 'required', 'name', 'type', 'class', 'multiple'])
@if (!empty($label))
    <label class="mb-1" for="{{ $name }}">
        {{ $label }} @if (!empty($required))
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<select class="form-select {{ $class ?? '' }} @error($name)  select_error_border @enderror " name="{{ $name }}"
    @if (!empty($multiple)) multiple @endif {{ $attributes->whereStartsWith('wire:model') }}>
    {{ $slot }}
</select>
@error($name)
    <span class="text-danger select_error">{{ $message }}</span>
@enderror
