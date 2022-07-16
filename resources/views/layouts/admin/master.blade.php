<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ setting('site_favicon') != null ?  Storage::disk('media')->url(setting('site_favicon')) : '' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="@yield('description')">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{ asset('backend/assets/styles/dropify.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend/main.css')}}" rel="stylesheet">
    @notifyCss
    @stack('css')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.admin.partials.header')
        <div class="app-main">
            @include('layouts.admin.partials.sidebar')
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        @yield('content')
                    </div>
                    @include('layouts.admin.partials.footer')
                </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('backend/assets/scripts/dropify.js')}}"></script>
    <script src="{{ asset('backend/assets/scripts/main.js')}}"></script>       
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/assets/scripts/scripts.js')}}"></script> 
    <x:notify-messages />
    @notifyJs
    @stack('js')
</body>
</html>
