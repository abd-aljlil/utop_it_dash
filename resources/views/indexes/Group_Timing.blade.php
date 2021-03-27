@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/css/dropdown-item-alert.css')}}" rel="stylesheet"  type="text/css" />
@endsection
@section('content')
@include('tables.Group_Timing')
@endsection
@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/Group_TimingVue.js') }}" type="text/javascript"></script>
<script>

$(function () {
  $("[type='number']").keydown(function () {
    // Save old value.
    if ( parseFloat($(this).val()) > 10){
		$(this).val(10);
	}
     
  });
  $("[type='number']").keyup(function () {
    // Check correct, else revert back to old value.
    if ( parseFloat($(this).val()) > 10){
		$(this).val(10);
	}

      
  });
  
});
</script>
@endsection