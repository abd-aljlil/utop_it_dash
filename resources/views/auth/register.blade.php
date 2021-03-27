@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">
<style>body{text-align:left; font-family: 'Amiri', serif !important} </style>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-center">{{ __('Volunteers Registration Form - فورم تسجيل المتطوعين') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}" dir="ltr">
                     {{ csrf_field() }}
                     <div class="form-group row">
                        <label for="name-en" class="col-md-4 col-form-label text-md-left">{{ __('Full Name (English) - الاسم إنجليزي') }}</label>

                        <div class="col-md-6">
                            <input id="name-en" type="text" class="form-control{{ $errors->has('name-en') ? ' is-invalid' : '' }}" name="name-en" value="{{ old('name-en') }}" placeholder="Full Name" required autofocus>

                            @if ($errors->has('name-en'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name-en') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name-ar" class="col-md-4 col-form-label text-md-left">{{ __('Full Name (Arabic) - الاسم عربي') }}</label>

                        <div class="col-md-6">
                            <input id="name-ar" type="text" class="form-control{{ $errors->has('name-ar') ? ' is-invalid' : '' }}" name="name-ar" value="{{ old('name-ar') }}" placeholder="For non-Arabs repeat your English Name"  required autofocus>

                            @if ($errors->has('name-ar'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name-ar') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-left">{{ __('Gender - الجنس') }}</label>

                        <div class="col-md-6" style="top: 9px;" >
                            <p class="pull-left"><input id="male" class="" type="radio" name="gender" value="1" required>
                            <label for='male'><i class="fa fa-male" aria-hidden="true"></i> Male</label></p>

                            <p class="pull-left">&nbsp;&nbsp;<input id="female" class="" type="radio" name="gender" value="2" required>
                            <label for='female'><i class="fa fa-female" aria-hidden="true"></i> Female</label></p>

                            @if ($errors->has('gender'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="birthdate" class="col-md-4 col-form-label text-md-left">{{ __('Date of Birth - تاريخ الميلاد') }}</label>

                        <div class="col-md-6">
                            <input id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" value="{{ old('birthdate') }}" required>

                            @if ($errors->has('birthdate'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email - الإيميل') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="سيستخدم للتواصل معك" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password - كلمة السر') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password - تأكيد كلمة السر') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-left">{{__('Role - الصلاحية') }}</label>

                        <div class="col-md-6">
                            <select name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" id="role" required>
                                <option class="form-control" value="">Choose - اختر</option>
                                @foreach ($roles as $role)
                                @if($role->name != 'SysAdministrator' )
                                <option class="form-control" value="{{$role->id}}">{{$role->name}} - {{$role->description}}</option>
                                @endif
                                @endforeach
                            </select>

                            @if ($errors->has('role'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!--<div class="form-group row">
                        <label for="fb" class="col-md-4 col-form-label text-md-left">{{ __('FB link - رابط حسابك الفيسبوك') }}</label>

                        <div class="col-md-6">
                            <input id="fb" type="text" class="form-control{{ $errors->has('fb') ? ' is-invalid' : '' }}" name="fb" value="{{ old('fb') }}" placeholder="http://facebook.com/A.B" required autofocus>

                            @if ($errors->has('fb'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('fb') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>-->

                    <div class="form-group row">
                        <label for="university" class="col-md-4 col-form-label text-md-left">{{ __('Educational Level - درجة الدراسة') }}</label>

                        <div class="col-md-6">

                          <select class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" id="university" name="university" required>
                            <option value="إعدادي">Primary School - إعدادي</option>
                            <option value="ثانوي">High School - ثانوي</option>
                            <option value="معهد متوسط">Institute - معهد متوسط</option>
                            <option value="إجازة جامعية">Bachelor's Degree - إجازة جامعية</option>
                            <option value="دبلوم">Diploma -  دبلوم</option>
                            <option value="ماجستير">Master -  ماجستير</option>
                            <option value="دكتوراه">PhD -  دكتوراه</option>
                        </select>

                        @if ($errors->has('university'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('university') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="specialization" class="col-md-4 col-form-label text-md-left">{{ __('Speciality - الاختصاص') }}</label>

                    <div class="col-md-6">
                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{ old('specialization') }}" required>

                        @if ($errors->has('specialization'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('specialization') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-left">{{ __('Country - بلد الإقامة') }}</label>

                    <div class="col-md-6">
                        <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" required>

                        @if ($errors->has('country'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-left">{{ __('City - مدينة الإقامة') }}</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>

                        @if ($errors->has('city'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                
                <input type="hidden" name="previous" value="0">
                <input type="hidden" name="level" value="null">
                <input type="hidden" name="preferred_time" value="0">
                <!--<div class="form-group row" >
                    <label for="level" class="col-md-4 col-form-label text-md-left">{{ __('ناجح إلى المستوى') }}</label>

                    <div class="col-md-6">
                        <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" id="level" name="level">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>

                        @if ($errors->has('level'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>-->
                
                <br>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                       <center> <button type="submit" class="btn btn-primary">
                            {{ __('Sign up - تسجيل') }}
                        </button></center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>
@endsection
