<meta charset="utf-8" />
<title>Coactive Dmc</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />

@php
    $faviconSetting = \App\Helpers\CommonHelper::masterSettingsName('favicon');
    $fileStorage = \App\Helpers\CommonHelper::masterSettingsName('file_storage')['master_value'] ?? 'local'; // Default to local if not set
@endphp
<link rel="icon" href="{{ $faviconSetting['master_value'] }}" type="image/png">

<!-- Vendor css -->
<link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

<!-- <link rel="stylesheet" href="assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css"> -->
<!-- Icons css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Theme Config Js -->
<script src="{{ asset('assets/js/config.js') }}"></script>




  

    

    
