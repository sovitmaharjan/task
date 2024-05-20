@if (Session::get('success'))
    <script>
        toastr.success('', '{{ Session::get('success') }}');
    </script>
@endif
@if (Session::get('info'))
    <script>
        toastr.info('', '{{ Session::get('info') }}');
    </script>
@endif
@if (Session::get('error'))
    <script>
        toastr.error('', '{{ Session::get('error') }}');
    </script>
@endif
