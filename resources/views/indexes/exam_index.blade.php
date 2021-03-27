@extends('layouts.fullwidth-app')
@section('style')
<link href="{{ URL::asset('assets/global/css/jquery_steps.css')}}" rel="stylesheet"  type="text/css" />

   

@endsection
@section('content')
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Form Actions On Bottom </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body form">

        <!-- BEGIN FORM-->
        <form action="#" class="form-horizontal" id="exam_form">
            <div class="form-body">
            
            <!-- <div class="form-group"> -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="col-md-12">
                            <div class="btn-group btn-group-circle">
                                <button type="button" class="btn btn-outline red btn-sm">
                                    <span>
                                        <h5 id="timer" class="timer-style"></h5>
                                    </span>
                                </button>    
                            </div><!--    .btn-group  -->
                        </div><!--    .col  -->
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="progress-container" > 
				<h6 class="text-center">put title</h6>
                                <div class="progress-indicator">
                                        <svg>
                                                <g>
                                                        <circle cx="0" cy="0" r="20" stroke="black" class="animated-circle" transform="translate(50,50) rotate(-90)"  />
                                                </g>
                                                <g>
                                                        <circle cx="0" cy="0" r="38" transform="translate(50,50) rotate(-90)"  />
                                                </g>
                                        </svg>
                                        <div class="progress-count">0%</div>
                                </div><!--    .progress-indicator -->
                            </div>  <!--    .progress-container -->
                        </div><!--    .col  -->
                    </div><!--    .col-2  -->

            <!-- </div> -->
            <div class="col-md-10"><!--    .col-9  -->
            <section class="tab">
            <div class="form-group">
                <label class="col-md-3 control-label">Checkboxes</label>
                <div class="col-md-9">
                    <div class="mt-checkbox-list cr-group ">
                        <label class="mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]"> Checkbox 1
                            <span></span>
                        </label>
                        <label class="mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]"> Checkbox 1
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]">Checkbox 2
                            <span></span>
                        </label>
                    </div>
                </div><!--.col-md-9--> 
            </div><!--.form-group--> 
            </section><!--.tab--> 
            <section class="tab">
            <div class="form-group">
                <label class="col-md-3 control-label">Radios</label>
                <div class="col-md-9">
                    <div class="mt-radio-list cr-group" data-error-container="#form_2_membership_error">
                        <label class="mt-radio">
                            <input type="radio" name="optionsRadios[]" id="optionsRadios22" value="option1"> Option 1
                            <span></span>
                        </label>
                        <label class="mt-radio">
                            <input type="radio" name="optionsRadios[]" id="optionsRadios23" value="option2" > Option 2
                            <span></span>
                        </label>
                        <label class="mt-radio">
                            <input type="radio" name="optionsRadios[]" id="optionsRadios24" value="option3" > Option 3
                            <span></span>
                        </label>
                    </div>
                    <div id="form_2_membership_error"> </div>
                </div><!--.col-md-9--> 
                
            </div>  <!--.form-group-->           
            
            </section><!--.tab--> 
            <section class="tab">
            <div class="form-group">
                <label class="col-md-3 control-label">Checkboxes</label>
                <div class="col-md-9">
                    <div class="mt-checkbox-list cr-group">
                        <label class="mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]"> Checkbox 1
                            <span></span>
                        </label>
                        <label class="mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]"> Checkbox 1
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox">
                            <input type="checkbox" name="checkbox_name[]"> Checkbox 1
                            <span></span>
                        </label>
                    </div><!--.mt-checkbox-list-->
                </div><!--.col-md-9--> 
            </div><!--.form-group--> 
            </section>   <!--.tab-->             
            <div class="form-actions">
                <div class="row">
                    <div class=" col-md-6 text-center">
                       
                        <a id="prevBtn" class="btn green" onclick="nextPrev(-1,'prev')">previous</a>
                    </div>
                    <div class=" col-md-6 text-center">
                        <a id="nextBtn" class="btn  green" onclick="nextPrev(1,'next')" >Next</a>
                        <button id="subBtn" class="btn  green btn-next hidden"  >submit</button>                    
                    </div>                    
                </div>
            </div>
                        </div><!--    .col-9  --> 
                </div><!--    .row  -->        
    </div> 
    
        </form>
        <!-- END FORM-->
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ URL::asset('assets/global/scripts/countdown_timer.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/scripts/exam_steps.js')}}" type="text/javascript"></script>

@endsection
