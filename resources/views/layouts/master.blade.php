<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />




    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>


    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- multiple select !  --}}
   {{-- <link rel="stylesheet" href={{asset('multi-select/filter_multi_select.css')}} />
<script src={{ asset('multi-select/filter-multi-select-bundle.min.js') }}></script> --}}

{{-- multiple selection  --}}
{{-- <script src={{ asset('multiselect-dropdown/multiselect-dropdown.js') }}></script> --}}

{{-- virtual select  --}}
   <link rel="stylesheet" href={{asset('public/new_modules/virtual-select/virtual-select.min.css')}} />
<script src={{ asset('public/new_modules/virtual-select/virtual-select.min.js') }}></script>



{{-- <script src={{asset('public/new_modules/assets/ckeditor/ckeditor5-premium-features.js')}}></script> --}}

<script src="{{ asset('public/new_modules/fullCalendar/jquery.min.js') }}"></script>
<script src="{{ asset('public/new_modules/fullCalendar/moment.min.js') }}"></script>


</script>







</head>
@php
$getSystemLogo = getSystemLogo();
@endphp

@section('body')

    <body
     {{-- data-sidebar="colored" --}}
     >
    @show
    <div id="layout-wrapper">
         @include('layouts.topbar')
        @include('layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.right-sidebar')
    @include('layouts.vendor-scripts')
     @yield('script')
</body>

</html>
