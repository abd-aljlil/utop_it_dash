@extends('layouts.app')
@section('style')
<link href="{{ asset('css/dashboard/vue-form-wizard.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dashboard/Exam.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div id="grid" >
    

   

    <tab-content title="Personal details" v-for="entry  in Groups" :key='entry.id'>
        <div class="form-group  ">
            <div>
              <h3 for="recipient-name" >@{{ entry.group_name }}</h3>
            </div>

            

        </div>
      </tab-content>
      
   
</div>
@endsection
@section('script')
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/vue-form-wizard.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dashboard/Join_GroupVue.js') }}" type="text/javascript"></script>

@endsection