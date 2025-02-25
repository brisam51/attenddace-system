
 <script src="{{ url('dashboard/js/vendor/modernizr.js') }}"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
    integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
</script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="{{ asset('dashboard/js/persianumber.min.js') }}"></script>
<script src="{{ asset('persian_datepicker/js/persian-date.js') }}"></script>
<script src="{{ asset('persian_datepicker/js/persian-datepicker.js') }}"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.min.js"></script>
<script src="{{asset('dashboard/js/main.js')}}"></script>
<script src="{{asset('dashboard/js/custom.js')}}"></script>
<script src="{{asset('dashboard/js/address-modal.js')}}"></script>
{{-- <script src="{{asset('dashboard/js/bank_user_info.js')}}"></script> --}}
@yield('script')
