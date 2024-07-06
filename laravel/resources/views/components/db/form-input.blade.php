<div class="form-floating form-floating-outline">
     <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
     <label for="{{ $id }}">{{ $label }}</label>
     @error($name)
     <div class="invalid-feedback">{{ $message }}</div>
     @enderror
 </div>