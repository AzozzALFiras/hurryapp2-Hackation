<x-layouts.dashboard.app-db>
     @inject('dev_3zozz', 'App\Http\Controllers\Helper\Dev_3zozzController')
   
   <!-- Content wrapper -->
   <div class="content-wrapper">
   
   <!-- Content -->
   
   <div class="container-xxl flex-grow-1 container-p-y">
   
   
   <div class="row gy-6">
   
   <x-db.table name="الاعدادات"
   url="{{ route('home.settings.create') }}"
    firstItem="{{ $Settings->firstItem() }}"
    lastItem="{{ $Settings->lastItem() }}"
    total="{{ $Settings->total() }}"
    dataTable="{{ $Settings->links('vendor.pagination.custom') }}">
   
   <x-db.table-header>
   <x-db.table-data>المفتاح</x-db.table-data>
   <x-db.table-data>القيمة</x-db.table-data>
   <x-db.table-data>التاريخ</x-db.table-data>
   <x-db.table-data>اكثر</x-db.table-data>
   
   </x-db.table-header>
   
   @foreach ($Settings as $setting)
   <x-db.table-row>
  
   <x-db.table-data>{{ $setting->key }}</x-db.table-data>
   <x-db.table-data>{{ $setting->value }}</x-db.table-data>
   <x-db.table-data>{{ $setting->created_at }}</x-db.table-data>
   <x-db.table-data>
   <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
        <div class="dropdown-menu">
        <a class="dropdown-item waves-effect text-danger" href="{{ route('home.settings.destroy', $setting->id) }}"><i class="ri-delete-bin-6-line me-1"></i> حذف</a>
          <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#editSetting-{{ $setting->id }}"  href=""><i class="ri-pencil-line me-1"></i>تعديل</a>
        </div>
      </div>
   </x-db.table-data>
   </x-db.table-row>
   
   

   <!-- Edit Settings Modal -->
   <div class="modal fade" id="editSetting-{{ $setting->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content">
            <div class="modal-body p-0">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-6">
                <h4 class="mb-2">تعديل الادعدادات</h4>
                <p class="mb-6">قم في اجراء التغيرات</p>
              </div>
              <form method="POST" enctype="multipart/form-data" action="{{ route('home.settings.update', $setting->id) }}" class="g-5 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="settingForm-{{$setting->id}}">
   
               @csrf
              
       
                  <div class="row"> 
                <div class="col-12 col-md-12 m-2 fv-plugins-icon-container">
                  <x-db.form-input name="key" type="text" id="key" value="{{ $setting->key }}" label="المفتاح" />
                </div>
                <div class="col-12 col-md-12 m-2 fv-plugins-icon-container">
                  <x-db.form-input name="value" type="text" id="value" value="{{ $setting->value }}" label="القيمة" />
                </div>          
             

                <div class="col-12 text-center">
                 <button type="submit"  class="btn btn-primary me-3">حفظ</button>
                 <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">الغاء</button>
                </div>
             </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Edit Settings Modal -->
  
   @endforeach
   
   
   
   
   </x-db.table>
   
   
   </div>
   
   
   
   </div>
   <!-- / Content -->
   </div>
   
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
   
    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
   
   <script>
   
   
   function submitForm(settingId) {
           // Initialize Quill for the editor associated with the settingId
           var quill = new Quill('#editor-' + settingId, {
               modules: {
                   toolbar: [
                       [{ 'header': [1, 2, false] }],
                       ['bold', 'italic', 'underline'],
                       ['link', 'image']
                   ]
               },
               theme: 'snow'
           });
   
           // Set the Quill content to the hidden input field
           document.getElementById('description-' + settingId).value = quill.root.innerHTML;
   
           // Submit the form programmatically
           document.getElementById('settingForm-' + settingId).submit();
       }
   
       // Quill initialization for each editor
       document.addEventListener('DOMContentLoaded', function () {
           var quills = {};
   
           var editorElements = document.querySelectorAll('.editor');
   
           editorElements.forEach(function (editorElement) {
               var quill = new Quill('#' + editorElement.id, {
                   bounds: '#' + editorElement.id,
                   placeholder: 'Type something...',
                   modules: {
                       formula: true,
                       toolbar: [
                           [{ font: [] }, { size: [] }],
                           ['bold', 'italic', 'underline', 'strike'],
                           [{ color: [] }, { background: [] }],
                           [{ script: 'super' }, { script: 'sub' }],
                           [{ header: '1' }, { header: '2' }, 'blockquote', 'code-block'],
                           [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                           [{ direction: 'rtl' }],
                           ['link', 'image', 'video', 'formula'],
                           ['clean']
                       ]
                   },
                   theme: 'snow'
               });
   
               // Store Quill instance in quills object
               quills['editor-' + editorElement.dataset.id] = quill;
           });
       });
       
   document.addEventListener('DOMContentLoaded', function () {
   
     
       var avatarElements = document.querySelectorAll('.uploadedAvatar');
   
       avatarElements.forEach(function (avatarElement) {
           var uploadInput = document.getElementById('upload-' + avatarElement.dataset.id);
           var uploadedAvatar = document.getElementById('uploadedAvatar-' + avatarElement.dataset.id);
   
           uploadInput.addEventListener('change', function () {
               var file = this.files[0];
   
               if (file) {
                   var reader = new FileReader();
   
                   reader.onload = function (e) {
                       uploadedAvatar.src = e.target.result;
                   };
   
                   reader.readAsDataURL(file);
               }
           });
           
       });
   });
   
   
   </script>
   
   
   </x-layouts.dashboard.app-db>
   