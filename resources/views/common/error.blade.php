<script type="text/javascript">
@if(Session::has('success'))
    toastr.success("{{Session::get('success')}}")
@elseif(Session::has('danger'))
    toastr.success({{Session::get('danger')}})
@elseif(Session::has('warning'))
    toastr.success({{Session::get('warning')}})
@endif
</script>