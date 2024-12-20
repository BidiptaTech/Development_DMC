<!-- resources/views/layouts/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')  <!-- Include header content here -->
</head>
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        @include('layouts.topbar')
        @yield('content')  

        @include('layouts.footer') 
        @yield('scripts') 
    </div>
</body>
</html>
