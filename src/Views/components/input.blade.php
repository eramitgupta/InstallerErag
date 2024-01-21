@props(['label', 'required', 'name', 'value', 'type', 'class', 'placeholder' , 'accept'])
@if (!empty($label))
    <label class="mb-1" for="{{ $name }}">{{ $label }} @if (!empty($required))<span class="text-danger">*</span>@endif</label>
@endif
<input type="{{ $type }}" name="{{ $name }}"
    class="form-control {{ $class ?? '' }} @error($name) is-invalid @enderror" @if (!empty($value)) value="{{ $value }}" @endif  placeholder="{{ $placeholder ?? '' }}"  @if (!empty($accept)) accept="{{ $accept }}" @endif >
