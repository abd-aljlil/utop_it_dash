@extends('layouts.app')
@section('content')
<style>html, body {
    text-align: right;
}</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-center">{{ __('فورم تسجيل الطلاب') }}</div>

                <div class="card-body">
                   
                    <form method="POST" action="{{ route('register') }}" dir="rtl">
                       {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="name-en" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الثلاثي بالإنكليزي') }}</label>

                            <div class="col-md-6">
                                <input id="name-en" type="text" class="form-control{{ $errors->has('name-en') ? ' is-invalid' : '' }}" name="name-en" value="{{ old('name-en') }}" placeholder='يستخدم لإصدار الشهادة' required autofocus>

                                @if ($errors->has('name-en'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name-en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name-ar" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الثلاثي بالعربي') }}</label>

                            <div class="col-md-6">
                                <input id="name-ar" type="text" class="form-control{{ $errors->has('name-ar') ? ' is-invalid' : '' }}" name="name-ar" value="{{ old('name-ar') }}" placeholder='يستخدم لإصدار الشهادة' required autofocus>

                                @if ($errors->has('name-ar'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name-ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('الجنس') }}</label>

                            <div class="col-md-6 " style="top: 9px;" >
                                <p class="pull-right"><input id="male" type="radio" name="gender" value="1" required>
                                <label for='male' class=""><i class="fa fa-male" aria-hidden="true"></i> ذكر</label></p> 
                                <p class="pull-right">&nbsp;&nbsp;<input id="female" class="" type="radio" name="gender" value="2" required>
                                <label for='female'><i class="fa fa-female" aria-hidden="true"></i> أنثى</label></p>

                                @if ($errors->has('gender'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ الميلاد') }}</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="date" style="text-align: right; direction: rtl" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" value="{{ old('birthdate') }}" required>

                                @if ($errors->has('birthdate'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة السر') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تأكيد كلمة السر') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <input type="hidden" id="role" name="role" value="1">

                        <!--<div class="form-group row">
                            <label for="fb" class="col-md-4 col-form-label text-md-right">{{ __('رابط حسابك الفيسبوك') }}</label>

                            <div class="col-md-6">
                                <input id="fb" type="text" class="form-control{{ $errors->has('fb') ? ' is-invalid' : '' }}" name="fb" value="{{ old('fb') }}" required autofocus>

                                @if ($errors->has('fb'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('درجة الدراسة') }}</label>

                            <div class="col-md-6">

                              <select class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" id="university" name="university" required>
                                <option value="إعدادي">إعدادي</option>
                                <option value="ثانوي">ثانوي</option>
                                <option value="معهد متوسط">معهد متوسط</option>
                                <option value="إجازة جامعية">إجازة جامعية</option>
                                <option value="دبلوم"> دبلوم</option>
                                <option value="ماجستير"> ماجستير</option>
                                <option value="دكتوراه"> دكتوراه</option>
                              </select>
                            
                                @if ($errors->has('university'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('الاختصاص') }}</label>

                            <div class="col-md-6">
                                <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="غير محدد" required>

                                @if ($errors->has('specialization'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('specialization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('بلد الإقامة') }}</label>

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
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('مدينة الإقامة') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" id="ifYesYes" style="display:none">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('ناجح إلى المستوى') }}</label>

                            <div id="ifYes" style="display:none" class="col-md-6">
                                <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" id="level" name="level">
                                <option value="null">اختر</option>
                                <option value="1">A1</option>
                                <option value="2">A2</option>
                                <option value="3">A2-B1</option>
                                <option value="4">B1</option>
                                <option value="5">B2</option>
                                <option value="6">C1</option>
                              </select>

                                @if ($errors->has('level'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preferred_time" class="col-md-4 col-form-label text-md-right">{{ __('نوع المجموعة الدراسية المفضل') }}</label>

                            <div class="col-md-6">

                              <select class="form-control{{ $errors->has('preferred_time') ? ' is-invalid' : '' }}" id="preferred_time" name="preferred_time" required>
                               <option value="مختلط">مختلط</option>
                               <option value="إناث فقط">إناث فقط</option>
                               
                              </select>
                            
                                @if ($errors->has('preferred_time'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('preferred_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <br>

                        <center>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تسجيل') }}
                                </button>  
                           </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYesYes').style.display = '';
        document.getElementById('ifYes').style.display = '';
    }
    else {
        document.getElementById('ifYes').style.display = 'none';
        document.getElementById('ifYesYes').style.display = 'none';
    }

}

</script>

@endsection
