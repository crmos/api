<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugin JavaScript-->
<script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>




<script>

    /**
     * Adds csrf token to ajax call
     */
    function callAjaxCsrfToken(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    /**
     * Initiate select2
     */
    function callSelect2(){
        $('.select2').select2();
    }

    callAjaxCsrfToken();
    callSelect2();
</script>