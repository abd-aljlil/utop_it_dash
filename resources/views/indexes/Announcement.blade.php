@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/vue-form-wizard.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dashboard/Exam.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('tables.Announcement')
@endsection
@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/vue-form-wizard.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/AnnouncementVue.js') }}" type="text/javascript"></script>

@endsection