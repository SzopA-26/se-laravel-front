@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        .input-aligned {
            line-height:34px;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container justify-content-center">
        <div class="">
            <div class="card" >
                <div class="card-body">
                    <h3 class="card-title text-center">แบบฟอร์มการจองห้อง</h3>
                    <form action="" METHOD="POST">
                        @csrf
                        <div  class="container m-md-3" style="padding-top: 2rem">
                            <dl class="row">
                                <dt class="col-sm-2 text-right ">ชื่อ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ $user["title"] }}{{ $user["first_name"] }}">
                                </dd>
                                <dt class="col-sm-2 text-right">นามสกุล :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ $user["last_name"] }}">
                                </dd>


                                <dt class="col-sm-2 text-right">ที่อยุ่ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ $user["address"] }}">
                                </dd>

                                <dt class="col-sm-2 text-right">เบอร์โทรศัพท์ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ $user["phone_number_1"] }}">
                                </dd>

                                <dt class="col-sm-2 text-right">อีเมล :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ $user["email"] }}">
                                </dd>

                                <dt for="checkin_date" class="col-sm-2 col-form-label text-md-right">วันที่ต้องการย้ายเข้า :</dt>

                                <dd class="col-sm-9">
                                    <input type="date" class="form-control w-50" id="checkin_date" name="checkin_date" value="{{ $request["checkIn_at"] }}" disabled>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </dd>

                                <input type="hidden" name="user_id" value="{{ $user["id"] }}">
                                <input type="hidden" name="room_id" value="{{ $request["room_id"]}}">

*
                            </dl>
                        </div>

                        <h3 class="card-title text-center">ข้อมูลห้อง</h3>
                        <div  class="container m-md-3" style="padding-top: 2rem">
                            <dl class="row">
                                <dt class="col-sm-2 text-right">ที่อยู่ :</dt>
                                <dd class="col-sm-9">{{ $building["address"] }}</dd>

                                <dt class="col-sm-2 text-right">ตึก :</dt>
                                <dd class="col-sm-9">{{ $building["name"] }}</dd>

                                <dt class="col-sm-2 text-right">ชั้น :</dt>
                                <dd class="col-sm-9">{{ $room["floor"] }}</dd>

                                <dt class="col-sm-2 text-right">เลขห้อง :</dt>
                                <dd class="col-sm-9">{{ $room["number"] }}</dd>

                                <dt class="col-sm-2 text-right">แบบห้อง :</dt>
                                <dd class="col-sm-9">{{ $type["name"] }}</dd>

                                <dt class="col-sm-2 text-right">ขนาด :</dt>
                                <dd class="col-sm-9">{{ $type["size"] }} ตร.ม.</dd>

                                <dt class="col-sm-2 text-right">เฟอร์นิเจอร์ :</dt>
                                <dd class="col-sm-9">เตียงคู่ ตู้เย็น ทีวี โต๊ะ เก้าอี้ ตู้เสื้อผ้า</dd>

                                <dt class="col-sm-2 text-right">ราคามัดจำ :</dt>
                                <dd class="col-sm-9">{{ $type["price"] }} บาท</dd>

                                <dt class="col-sm-2 text-right">ราคาเช่าล่วงหน้า :</dt>
                                <dd class="col-sm-9">{{ $type["price"] }} บาท</dd>

                                <dt class="col-sm-2 text-right">ค่าน้ำ :</dt>
                                <dd class="col-sm-9">{{ $building["water_rate"] }} บาทต่อยูนิต</dd>
                                <dt class="col-sm-2 text-right">ค่าไฟ :</dt>
                                <dd class="col-sm-9">{{ $building["electric_rate"] }} บาทต่อยูนิต</dd>

                                <dt class="col-sm-2 text-right">สัญญา :</dt>
                                <dd class="col-sm-9">1 ปี</dd>

                            </dl>
                        </div>
                        @if($request['status'] == 'รอการยืนยัน')
                        <div class="text-center">
                            <form id="deleteForm" onsubmit="return confirm('ต้องการลบคำขอนี้หรือไม่')"
                                  action="{{ route('requests.destroy', ['request' => $request["id"]]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-lg" type="submit">ไม่อนุมัติ</button>
                            </form>
                            <a type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#request">อนุมัติ</a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการจองห้องพัก</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ยืนยันการส่งรายงานนี้หรือไม่
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                        <a  href="{{ route('requests.admin.confirm', ['request' => $request["id"]]) }}"><button type="submit" class="btn btn-primary">ยืนยัน</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
            </div>


        </div>

    </div>
@endsection
