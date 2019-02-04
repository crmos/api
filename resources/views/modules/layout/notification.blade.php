<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .swal-button {
        padding: 7px 19px;
        border-radius: 2px;
        background-color: rgb(228, 22, 22);
        font-size: 12px;
        border: 1px solid rgb(43, 4, 4);
        text-shadow: rgba(0, 0, 0, 0.3) 0px -1px 0px;
    }
</style>
<script>

    @if(Session::has('success'))
    swal("Success!", "{!! Session::get('success') !!}", "success");
    @endif

    @if(Session::has('warning'))
    swal("Warning!", "{!! Session::get('warning') !!}", "warning");
    @endif

    @if(Session::has('danger'))
    swal("Error!", "{!! Session::get('danger') !!}", "error");
    @endif

    @if(Session::has('error'))
    swal("Error!", "{!! Session::get('error') !!}", "error");
    @endif

    @if(Session::has('info'))
    swal("Info!", "{!! Session::get('info') !!}", "info");
    @endif

</script>