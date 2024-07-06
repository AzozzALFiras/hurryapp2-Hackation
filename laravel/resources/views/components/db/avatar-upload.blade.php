@empty($id)
<div class="d-flex align-items-start align-items-sm-center gap-6">
    <img src="{{ URL::to($src) }}" alt="user-avatar" class="uploadedAvatar d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
    <div class="button-wrapper">
        <label for="upload" class="btn btn-sm btn-primary me-3 mb-4 waves-effect waves-light" tabindex="0">
            <span class="d-none d-sm-block">@lang('dashboard.uploadNewPhoto')</span>
            <i class="ri-upload-2-line d-block d-sm-none"></i>
            <input type="file" name="image" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg">
        </label>
        <div>Allowed JPG, GIF or PNG. Max size of 5M</div>
    </div>
</div>
@endempty
@empty(!$id)
    <div class="d-flex align-items-start align-items-sm-center gap-6">
    <img src="{{ URL::to($src) }}" alt="user-avatar" class="uploadedAvatar d-block w-px-100 h-px-100 rounded" data-id="{{$id}}" id="uploadedAvatar-{{$id}}">
    <div class="button-wrapper">
        <label for="upload-{{$id}}" class="btn btn-sm btn-primary me-3 mb-4 waves-effect waves-light" tabindex="0">
            <span class="d-none d-sm-block">@lang('dashboard.uploadNewPhoto')</span>
            <i class="ri-upload-2-line d-block d-sm-none"></i>
            <input type="file" name="image" id="upload-{{$id}}" class="account-file-input" hidden accept="image/png, image/jpeg">
        </label>
        <div>Allowed JPG, GIF or PNG. Max size of 5M</div>
    </div>
</div>
@endempty

