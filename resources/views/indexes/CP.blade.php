@extends('layouts.app')
@section('style')
@endsection
@section('content')
@include('tables.CP')
@endsection

@section('script')
<script src="{{ URL::asset('js/dashboard/vue.js') }}" type="text/javascript"></script>

@endsection



