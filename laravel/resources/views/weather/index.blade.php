@inject('dev_3zozz', 'App\Http\Controllers\Helper\Dev_3zozzController')

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    <title>Frontend</title>
    <style>
        .table .thead-blue th {
            color: #fff;
            background-color: #167af6;
            border-color: #167af6;
            font-weight: 400;
        }
        .pagination {
            justify-content: center;
        }
        .pagination .page-item .page-link {
            color: #007bff;
            border: 1px solid #dee2e6;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }

    </style>
</head>
<body>
@include('web.navbar')

<div class="page-content page-container" id="page-content">
    <div class="mt-5">
        <div class="col-lg-10 container d-flex justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <!--weather card-->
                <div class="card card-weather rounded">
                    <div class="card-body">
                        <div class="weather-date-location d-flex justify-content-between align-items-center">
                            <div class="mr-md-5">
                                <h3>{{ $day }}</h3>
                                <p class="text-gray">
                                    <span class="weather-date">{{ $date }}</span>
                                    <span class="weather-location">{{ $location }}</span>
                                </p>
                            </div>
                            <div class="text-end ml-md-5">
                                <h4 class="display-3">
                                    {{ $info ? $info->tempC : $weather['current']['temp_c'] }}
                                    <span class="symbol">&deg;</span>م
                                </h4>
                                <p>
                                    <h3>{{ $weather['current']['condition']['text'] }}
                                        <img loading="lazy" src="{{ $weather['current']['condition']['icon'] }}" alt="">
                                    </h3>
                                </p>
                                <div>
                                    <h5>جودة الهواء</h5>
                                    @if (isset($info->air_quality_label))
                                        @php
                                            $airQualityLabel = $info->air_quality_label;
                                            $airQualityClass = 'badge-' . ($airQualityLabel == 'Excellent' ? 'success' : ($airQualityLabel == 'Moderate' ? 'warning' : 'danger'));
                                            $airQualityLabelArabic = ($airQualityLabel == 'Excellent' ? 'ممتازة' : ($airQualityLabel == 'Moderate' ? 'معتدلة' : 'سيئة'));
                                        @endphp
                                        <p>الحالة: <span class="badge {{ $airQualityClass }}">{{ $airQualityLabelArabic }}</span></p>
                                    @else
                                        <p>الحالة: <span class="badge badge-secondary">غير معروف</span></p>
                                    @endif
                                    @empty(!$info)
                                    <p>PM2.5: {{ $info->dsm_consentrate }} µg/m³ <span class="badge {{ $info->dsm_consentrate > 50 ? 'bg-danger' : 'bg-success' }}">{{ $info->dsm_consentrate > 50 ? 'عالي' : 'طبيعي' }}</span></p>
                                    <p>CO2: {{ $info->sensor_value }} ppm <span class="badge {{ $info->sensor_value > 1000 ? 'bg-danger' : 'bg-success' }}">{{ $info->sensor_value > 1000 ? 'عالي' : 'طبيعي' }}</span></p>
                                    @endempty
                                    <p>درجة الحرارة: {{ $info ? $info->tempC : $weather['current']['temp_c'] }}°C <span class="badge {{ $info && $info->tempC > 30 ? 'bg-danger' : 'bg-success' }}">{{ $info && $info->tempC > 30 ? 'عالي' : 'طبيعي' }}</span></p>
                                    <p>الرطوبة: {{ isset($weather['current']['humidity']) ? $weather['current']['humidity'] : $info->humi }}% <span class="badge {{ isset($weather['current']['humidity']) && $weather['current']['humidity'] > 70 ? 'bg-danger' : 'bg-success' }}">{{ isset($weather['current']['humidity']) && $weather['current']['humidity'] > 70 ? 'عالي' : 'طبيعي' }}</span></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex weakly-weather">
                            @foreach ($weather['forecast']['forecastday'] as $day)
                            <div class="weakly-weather-item">
                                <a href="{{ route('web.details') }}?dt={{ $day['date'] }}">
                                    <p class="mb-0">
                                        {{ $dev_3zozz::getDayNameFromDate($day['date']) }} <br>{{ $day['date'] }}
                                    </p>
                                    <i class="mdi mdi-weather-cloudy"></i>
                                    <p class="mb-0">
                                        {{ $day['day']['maxtemp_c'] }}&deg; | {{ $day['day']['condition']['text'] }} <img loading='lazy' src="{{ $day['day']['condition']['icon'] }}" alt="">
                                    </p>
                                </a>
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--weather card ends-->
            </div>
        </div>
    </div>
</div>
@include('web.search')

<div class="container mt-5" id="history">
    <h2 class="text-right">سجل النشاطات</h2>

    {{-- Date filter --}}
    <form action="{{ route('web.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="date_from" class="form-label">من تاريخ:</label>
                <input type="date" id="date_from" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-4">
                <label for="date_to" class="form-label">إلى تاريخ:</label>
                <input type="date" id="date_to" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">تطبيق البحث</button>
            </div>
        </div>
    </form>

    {{-- Activity logs table --}}
    <table class="table table-striped table-bordered">
        <thead class="thead-blue">
            <tr>
                <th>المدينة</th>
                <th>درجة الحرارة</th>
                <th>نسبة الرطوبة</th>
                <th>تركيز DSM</th>
                <th>عدد الجسيمات DSM</th>
                <th>جودة الهواء</th>
                <th>الجهاز الاستشعار</th>
                <th>تاريخ الانشاء</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($saveLogs as $row)
                @php
                    $response = json_decode($row->message);
                @endphp
                <tr>
                    <td>Baghdad</td>
                    <td>{{ $response->tempC }}</td>
                    <td>{{ $response->humi }}</td>
                    <td>{{ $response->dsm_consentrate }}</td>
                    <td>{{ $response->dsm_particle }}</td>
                    <td>{{ $response->air_quality_label }}</td>
                    <td>{{ $response->sensor_value }}</td>
                    <td>{{ $row->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="font-size: 20px;" class="text-center">لا توجد نتائج متاحة</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>

    <div class="d-flex justify-content-center">
        {{ $saveLogs->appends(request()->query())->links('vendor.pagination.bootstrap4') }}
    </div>
</div>


@include('web.team')
@include('web.footer')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/2a65d6b249.js" crossorigin="anonymous"></script>
</body>
</html>
