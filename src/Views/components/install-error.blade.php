@props(['for'])
@error($for)
    <span class="text-danger invalid-feedback">{{ $message }}</span>
@enderror
