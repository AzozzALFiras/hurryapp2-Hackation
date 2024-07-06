    <!-- City Search -->
    <section class="bg-primary text-light p-5">
     <div class="container">
         <div class="d-md-flex justify-content-between align-items-center">
             <h3 class="mb-3 mb-md-0">ابحث عن مدينتك</h3>
             <form action="{{ route('web.index') }}" method="GET">
             <div class="input-group news-input w-100">
                 <input type="text" name="search" required class="form-control" placeholder="أسم المدينة" />
                 <button class="btn btn-dark btn-lg" type="submit">بحث</button>
             </div>
            </form>

         </div>
     </div>
 </section>