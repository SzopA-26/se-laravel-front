@extends('layouts.app')

@section('style')
    <style>
        .required-red {
            color: red;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('สมัครสมาชิก') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return confirm('ยืนยันข้อมูลทั้งหมดถูกต้อง')">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">อีเมล <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่าน <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">คำนำหน้าชื่อ <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <select id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                                    <option value="นาย" selected>นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">ชื่อ <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">นามสกุล <label class="required-red">*</label></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class="form-group row" id="birthdatepicker">--}}
{{--                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">วันเกิด <label class="required-red">*</label></label>--}}

{{--                            <div class="col-md-6">--}}
{{--                            <input type="date" class="form-control" id="birth_date" name="birth_date">--}}
{{--                                <span class="input-group-addon">--}}
{{--                                    <span class="glyphicon glyphicon-time"></span>--}}
{{--                                </span>--}}

{{--                                @error('birth_date')--}}
{{--                                <span class="invalid-feedback" role=" alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="citizen_id" class="col-md-4 col-form-label text-md-right">รหัสประจำตัวประชาชน <label class="required-red">*</label></label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="citizen_id" type="text" class="form-control @error('citizen_id') is-invalid @enderror" name="citizen_id" value="{{ old('citizen_id') }}" required>--}}

{{--                                @error('citizen_id')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="address" class="col-md-4 col-form-label text-md-right">ที่อยู่ <label class="required-red">*</label></label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>--}}

{{--                                @error('address')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="phone_number_1" class="col-md-4 col-form-label text-md-right">เบอร์ติดต่อ 1 <label class="required-red">*</label></label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="phone_number_1" type="text" class="form-control @error('phone_number_1') is-invalid @enderror" name="phone_number_1" value="{{ old('phone_number_1') }}" required>--}}

{{--                                @error('phone_number_1')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="phone_number_2" class="col-md-4 col-form-label text-md-right">เบอร์ติดต่อ 2</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="phone_number_2" type="text" class="form-control @error('phone_number_2') is-invalid @enderror" name="phone_number_2" value="{{ old('phone_number_2') }}">--}}

{{--                                @error('phone_number_2')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('สมัตรสมาชิก') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

