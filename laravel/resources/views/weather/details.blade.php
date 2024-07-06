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
               <div class="container mt-5">
                 <h2 class="text-right">تفاصيل اليوم</h2>
                 <table class="table table-striped table-bordered text-right">
                   <thead class="thead-blue">
                     <tr>
                       <th>المعلومات</th>
                       <th>القراءات</th>
                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <td>اليوم</td>
                       <td>{{ $dev_3zozz::getDayNameFromDate($weather['forecast']['forecastday'][0]['date']) }}</td>
                     </tr>
                     <tr>
                       <td>التاريخ</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['date'] }}</td>
                     </tr>
                     <tr>
                       <td>الحالة</td>
                       <td>
                         {{ $weather['current']['condition']['text'] }}
                         <img loading="lazy" src="{{ $weather['current']['condition']['icon'] }}" alt="{{ $weather['current']['condition']['text'] }}">
                       </td>
                     </tr>
                     <tr>
                       <td>سرعة الرياح (mph)</td>
                       <td>{{ $weather['current']['wind_mph'] }}</td>
                     </tr>
                     <tr>
                       <td>سرعة الرياح (kph)</td>
                       <td>{{ $weather['current']['wind_kph'] }}</td>
                     </tr>
                     <tr>
                       <td>زاوية الرياح</td>
                       <td>{{ $weather['current']['wind_degree'] }}</td>
                     </tr>
                     <tr>
                       <td>اتجاه الرياح</td>
                       <td>{{ $weather['current']['wind_dir'] }}</td>
                     </tr>
                     <tr>
                       <td>الضغط (mb)</td>
                       <td>{{ $weather['current']['pressure_mb'] }}</td>
                     </tr>
                     <tr>
                       <td>الضغط (in)</td>
                       <td>{{ $weather['current']['pressure_in'] }}</td>
                     </tr>
                     <tr>
                       <td>مقدار الأمطار (mm)</td>
                       <td>{{ $weather['current']['precip_mm'] }}</td>
                     </tr>
                     <tr>
                       <td>مقدار الأمطار (in)</td>
                       <td>{{ $weather['current']['precip_in'] }}</td>
                     </tr>
                     <tr>
                       <td>الرطوبة (%)</td>
                       <td>{{ $weather['current']['humidity'] }}</td>
                     </tr>
                     <tr>
                       <td>السحب (%)</td>
                       <td>{{ $weather['current']['cloud'] }}</td>
                     </tr>
                     <tr>
                       <td>الشعور بالحرارة (°C)</td>
                       <td>{{ $weather['current']['feelslike_c'] }}</td>
                     </tr>
                     <tr>
                       <td>الشعور بالحرارة (°F)</td>
                       <td>{{ $weather['current']['feelslike_f'] }}</td>
                     </tr>
                     <tr>
                       <td>درجة البرودة بالحرارة (°C)</td>
                       <td>{{ $weather['current']['windchill_c'] }}</td>
                     </tr>
                     <tr>
                       <td>درجة البرودة بالحرارة (°F)</td>
                       <td>{{ $weather['current']['windchill_f'] }}</td>
                     </tr>
                     <tr>
                       <td>مؤشر الحرارة (°C)</td>
                       <td>{{ $weather['current']['heatindex_c'] }}</td>
                     </tr>
                     <tr>
                       <td>مؤشر الحرارة (°F)</td>
                       <td>{{ $weather['current']['heatindex_f'] }}</td>
                     </tr>
                     <tr>
                       <td>درجة الندى (°C)</td>
                       <td>{{ $weather['current']['dewpoint_c'] }}</td>
                     </tr>
                     <tr>
                       <td>درجة الندى (°F)</td>
                       <td>{{ $weather['current']['dewpoint_f'] }}</td>
                     </tr>
                     <tr>
                       <td>الرؤية (km)</td>
                       <td>{{ $weather['current']['vis_km'] }}</td>
                     </tr>
                     <tr>
                       <td>الرؤية (miles)</td>
                       <td>{{ $weather['current']['vis_miles'] }}</td>
                     </tr>
                     <tr>
                       <td>نسمة عاتية (mph)</td>
                       <td>{{ $weather['current']['gust_mph'] }}</td>
                     </tr>
                     <tr>
                       <td>نسمة عاتية (kph)</td>
                       <td>{{ $weather['current']['gust_kph'] }}</td>
                     </tr>
                     <tr>
                       <td>هل ستمطر؟</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_will_it_rain'] }}</td>
                     </tr>
                     <tr>
                       <td>هل ستتساقط الثلوج؟</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_will_it_snow'] }}</td>
                     </tr>
                     <tr>
                       <td>أعلى درجة حرارة (°C)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['maxtemp_c'] }}</td>
                     </tr>
                     <tr>
                       <td>أعلى درجة حرارة (°F)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['maxtemp_f'] }}</td>
                     </tr>
                     <tr>
                       <td>أدنى درجة حرارة (°C)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['mintemp_c'] }}</td>
                     </tr>
                     <tr>
                       <td>أدنى درجة حرارة (°F)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['mintemp_f'] }}</td>
                     </tr>
                     <tr>
                       <td>متوسط درجة الحرارة (°C)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['avgtemp_c'] }}</td>
                     </tr>
                     <tr>
                       <td>متوسط درجة الحرارة (°F)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['avgtemp_f'] }}</td>
                     </tr>
                     <tr>
                       <td>أقصى سرعة رياح (mph)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['maxwind_mph'] }}</td>
                     </tr>
                     <tr>
                       <td>أقصى سرعة رياح (kph)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['maxwind_kph'] }}</td>
                     </tr>
                     <tr>
                       <td>إجمالي هطول الأمطار (mm)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['totalprecip_mm'] }}</td>
                     </tr>
                     <tr>
                       <td>إجمالي هطول الأمطار (in)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['totalprecip_in'] }}</td>
                     </tr>
                     <tr>
                       <td>إجمالي تساقط الثلوج (cm)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['totalsnow_cm'] }}</td>
                     </tr>
                     <tr>
                       <td>متوسط الرؤية (km)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['avgvis_km'] }}</td>
                     </tr>
                     <tr>
                       <td>متوسط الرؤية (miles)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['avgvis_miles'] }}</td>
                     </tr>
                     <tr>
                       <td>متوسط الرطوبة (%)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['avghumidity'] }}</td>
                     </tr>
                     <tr>
                       <td>هل ستمطر؟</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_will_it_rain'] }}</td>
                     </tr>
                     <tr>
                       <td>فرصة هطول الأمطار (%)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_chance_of_rain'] }}</td>
                     </tr>
                     <tr>
                       <td>هل ستتساقط الثلوج؟</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_will_it_snow'] }}</td>
                     </tr>
                     <tr>
                       <td>فرصة تساقط الثلوج (%)</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['daily_chance_of_snow'] }}</td>
                     </tr>
                   
                     <tr>
                       <td>الاشعة الفوق البنفسجية</td>
                       <td>{{ $weather['forecast']['forecastday'][0]['day']['uv'] }}</td>
                     </tr>
                     <tr>
                         <td>شروق الشمس</td>
                         <td>{{ $weather['forecast']['forecastday'][0]['astro']['sunrise'] }}</td>
                       </tr>
                       <tr>
                         <td>غروب الشمس</td>
                         <td>{{ $weather['forecast']['forecastday'][0]['astro']['moonset'] }}</td>
                       </tr>
                    
                   </tbody>
                 </table>
               </div>
             </div>
             
    </div>
</div>

@include('web.footer')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/2a65d6b249.js" crossorigin="anonymous"></script>
</body>
</html>
