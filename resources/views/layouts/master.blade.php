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
    <link rel="icon" href="
    @if ($fileStorage === 'local')
        {{ URL::asset('build/images/' . ($faviconSetting['master_value'] ?? 'default-favicon.png')) }}
    @elseif ($fileStorage === 's3')
        {{ $faviconSetting['master_value'] ? Storage::disk('s3')->url($faviconSetting['master_value']) : URL::asset('build/images/default-favicon.png') }}
    @elseif ($fileStorage === 'azure')
        {{ $faviconSetting['master_value'] ? Storage::disk('azure')->url($faviconSetting['master_value']) : URL::asset('build/images/default-favicon.png') }}
    @else
        {{ URL::asset('build/images/default-favicon.png') }}
    @endif
    " type="image/png">
    <title>@yield('title') | Coactive admin panel</title>
    @yield('css')
    @include('layouts.head-css')

</head>

<body>

@include('layouts.topbar')
@include('layouts.sidebar')

<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">

        @yield('content')

    </div>
</main>
<!--end main wrapper-->

<!--start overlay-->
    <div class="overlay btn-toggle"></div>
<!--end overlay-->

  @include('layouts.footer')

  @include('layouts.cart')

  @include('layouts.right-sidebar')

  @include('layouts.vendor-scripts')

  @yield('scripts')

</body>
  
</html>
