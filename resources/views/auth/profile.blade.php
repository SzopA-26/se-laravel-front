@extends('layouts.app')

@section('style')
    <style>
        .required-red {
            color: red;
        }
        img {
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <h4>{{ __('ข้อมูลของฉัน') }}</h4>
                            </div>
                            <div class="col">
                                <div class="text-right">
                                    @if(Auth::user()->role != 'staff')
                                    <a type="button" class="btn btn-primary" href="{{ route('user.edit', ['user' => $user->id]) }}">
                                        {{ __('แก้ไขข้อมูล') }}
                                    </a>
                                    @endif
                                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#changeImgModal">
                                        {{ __('เปลี่ยนรูปประจำตัว') }}
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
                                        {{ __('เปลี่ยนรหัสผ่าน') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="justify-content-center text-center">
                        @if(!$user->img)
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="profile picture" width="200" height="200">
                        @else
                            <img src="{{ $user->img }}" alt="profile picture" width="200" height="200">
                        @endif
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">อีเมล </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">คำนำหน้าชื่อ </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control " name="title" value="{{ $user->title }}" disabled>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">ชื่อ </label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">นามสกุล </label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control " name="last_name" value="{{ $user->last_name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row" id="birthdatepicker">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">วันเกิด </label>

                            <div class="col-md-6">
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" disabled>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="citizen_id" class="col-md-4 col-form-label text-md-right">รหัสประจำตัวประชาชน </label>

                            <div class="col-md-6">
                                <input id="citizen_id" type="text" class="form-control" name="citizen_id" value="{{ $user->citizen_id }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">ที่อยู่ </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control " name="address" value="{{ $user->address }}" disabled>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number_1" class="col-md-4 col-form-label text-md-right">เบอร์ติดต่อ
                            @if($user->phone_number_2)
                                1
                            @endif
                            </label>

                            <div class="col-md-6">
                                <input id="phone_number_1" type="text" class="form-control " name="phone_number_1" value="{{ $user->phone_number_1 }}" disabled>
                            </div>
                        </div>

                        @if($user->phone_number_2)
                        <div class="form-group row">
                            <label for="phone_number_2" class="col-md-4 col-form-label text-md-right">เบอร์ติดต่อ 2</label>

                            <div class="col-md-6">
                                <input id="phone_number_2" type="text" class="form-control " name="phone_number_2" value="{{ $user->phone_number_2 }}" disabled>
                            </div>
                        </div>
                        @endif

                        <div class="modal fade" id="changeImgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรูปประจำตัว</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('user.update.img', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input class="form-control-file @error('img') is-invalid @enderror" name="img" id="img"
                                                   type="file" value="upload">
                                            @error('img')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <a href="{{ route('user.delete.img', ['user' => $user->id]) }}"
                                               class="btn btn-danger" onsubmit="return confirm('ต้องการลบรูปประจำตัวหรือไม่')">ลบรูปประจำตัว</a>
                                            <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('user.update.password', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="old-password" class="col-md-4 col-form-label text-md-right">รหัสผ่านปัจจุบัน <label class="required-red">*</label></label>

                                                <div class="col-md-6">
                                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>

                                                    @error('old_password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่านใหม่ <label class="required-red">*</label></label>

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
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่านใหม่ <label class="required-red">*</label></label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endsection

