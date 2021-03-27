@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/Exam_Name.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('tables.Exam_Name')
@endsection
@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/Exam_NameVue.js') }}" type="text/javascript"></script>
@endsection



