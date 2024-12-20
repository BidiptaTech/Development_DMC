<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    @php
    $faviconSetting = \App\Helpers\CommonHelper::masterSettingsName('favicon');
    $fileStorage = \App\Helpers\CommonHelper::masterSettingsName('file_storage')['master_value'] ?? 'local'; // Default to local if not set
    @endphp
    <link rel="icon" href="{{ $faviconSetting['master_value'] }}" type="image/png">
    <title>@yield('title') | Coactive Dmc</title>

    @yield('css')

    @include('layouts.head-css')

</head>

<body>
    @yield('content')

<!--start overlay-->
<div class="overlay btn-toggle"></div>
<!--end overlay-->

  @include('layouts.vendor-scripts')
  <script>
    $(document).ready(function () {
      $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bi-eye-slash-fill");
          $('#show_hide_password i').removeClass("bi-eye-fill");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bi-eye-slash-fill");
          $('#show_hide_password i').addClass("bi-eye-fill");
        }
      });
    });
  </script>

  @yield('scripts')


</body>
  
</html>