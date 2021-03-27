@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/css/dropdown-item-alert.css')}}" rel="stylesheet"  type="text/css" />
@endsection
@section('content')
@include('tables.Courses')
@endsection

@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>


<script src="{{ URL::asset('js/dashboard/CourseVue.js') }}" type="text/javascript"></script>

@endsection



