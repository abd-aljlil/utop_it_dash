@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('tables.User_Manag')
@endsection
@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/User_ManagVue.js') }}" type="text/javascript"></script>
@endsection