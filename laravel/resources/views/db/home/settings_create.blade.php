<x-layouts.dashboard.app-db>
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="card mb-6">
             <!-- Account -->
             <div class="card-body pt-0">
                 <form method="POST" enctype="multipart/form-data" action="{{ route('home.settings.create') }}" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="licenseForm">
                     @csrf
                  
                     <div class="row mt-1 g-5">
                         <div class="col-md-6 fv-plugins-icon-container">
                             <x-db.form-input name="key" type="text" id="key" value="" label="المفتاح" />
                         </div>
                         <div class="col-md-6">
                             <x-db.form-input name="value" type="text" id="value" value="" label="القيمة" />
                         </div>
                         

                      
                     </div>
                  
                     <div class="mt-6">
                         <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">حفظ</button>
                         <button type="reset" class="btn btn-outline-secondary waves-effect">ترسيت</button>
                     </div>
                     <input type="hidden">
                 </form>
             </div>
             <!-- /Account -->
         </div>
     </div>
 
 
 
 
 </x-layouts.dashboard.app-db>
 