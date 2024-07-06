@if(session('success') || session('error'))
<div class="container-xxl flex-grow-1 container-p-y">
     <div class="card">
         <div class="card-body">
             @if(session('success'))
                 <div class="alert alert-success alert-dismissible" role="alert">
                     <h4 class="alert-heading d-flex align-items-center"><span class="alert-icon rounded"><i class="ri-checkbox-circle-line ri-22px"></i></span>Well done :)</h4>
                     <hr>
                     <p class="mb-0">{{ session('success') }}</p>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
 
             @if(session('error'))
                 <div class="alert alert-danger alert-dismissible" role="alert">
                     <h4 class="alert-heading d-flex align-items-center"><span class="alert-icon rounded"><i class="ri-error-warning-line ri-22px"></i></span>Error!!</h4>
                     <p>{{ session('error') }}</p>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
         </div>
     </div>
 </div>
 @endif
 