<!-- JAVASCRIPT -->
<script src="{{ URL::asset('public/new_modules/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/waypoints/waypoints.min.js') }}"></script>
<script src="{{ URL::asset('public/new_modules/assets/libs/jquery-counterup/jquery-counterup.min.js') }}"></script>

<script src="{{ asset('public/new_modules/nepalidate/nepali-date-picker.min.js') }}?v=<?php echo date('YmdHis'); ?>"></script>

<script src="{{ asset('public/new_modules/nepalidate/converter.js') }}?v=<?php echo date('YmdHis'); ?>"></script>

<!-- App js -->
<script src="{{ URL::asset('public/new_modules/assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('script-bottom')
