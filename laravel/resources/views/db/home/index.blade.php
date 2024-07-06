<x-layouts.dashboard.app-db>
  @inject('dev_3zozz', 'App\Http\Controllers\Helper\Dev_3zozzController')

<!-- Content wrapper -->
<div class="content-wrapper">

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">


<div class="row gy-6">

<x-db.table name="السجل"
url=""
 firstItem="{{ $SaveLog->firstItem() }}"
 lastItem="{{ $SaveLog->lastItem() }}"
 total="{{ $SaveLog->total() }}"
 dataTable="{{ $SaveLog->links('vendor.pagination.custom') }}">

<x-db.table-header>
<x-db.table-data>المدينة</x-db.table-data>
<x-db.table-data>درجة الحرارة</x-db.table-data>
<x-db.table-data>نسبة الرطوبة</x-db.table-data>
<x-db.table-data>تركيز DSM</x-db.table-data>
<x-db.table-data>عدد الجسيمات DSM</x-db.table-data>
<x-db.table-data>جودة الهواء</x-db.table-data>
<x-db.table-data>الجهاز الاستشعار</x-db.table-data>
<x-db.table-data>تاريخ الانشاء</x-db.table-data>

</x-db.table-header>

@foreach ($SaveLog as $row)

<x-db.table-row>

<x-db.table-data>
  Baghdad
</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->tempC }}</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->humi }}</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->dsm_consentrate }}</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->dsm_particle }}</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->air_quality_label }}</x-db.table-data>
<x-db.table-data>{{ json_decode($row->message)->sensor_value }}</x-db.table-data>



{{-- <x-db.table-data>
<x-db.badge class="bg-label-success" label="{{ $row->status }}" />
</x-db.table-data> --}}
<x-db.table-data>{{ $row->created_at }}</x-db.table-data>

</x-db.table-row>


@endforeach




</x-db.table>


</div>



</div>
<!-- / Content -->
</div>



</x-layouts.dashboard.app-db>
