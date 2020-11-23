@extends('layouts.app')

@section('style')
    <style>
        .head-bot{
            margin: auto;
            height: 160px;
            border-bottom: solid 1px darkgray;
            max-width: 1300px;
        }

        .center{
            margin: auto;
        }

        .icon-head{
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .center-item{
            justify-content: center;
        }

        .inner{
            margin-right: 50px;
        }

        .alert-message{
            padding: 20px 20px 0;
            border-right: 1px solid;
            border-bottom: 1px solid;
            border-radius: 0px 26px 26px 26px;
        }

        .header-text{
            -webkit-text-stroke: 1px black;
            color: white;
            text-shadow:
                3px 3px 0 #000,
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
            margin-top: 30px;
            font-size: 50px;
        }

        .price{
            color: gray;
        }

        .divider{
            width: 400px;
            border-bottom: 3px double slategray;
            margin-bottom: 5px;
        }

        p{
            margin-bottom: 0.3rem;
        }

        .errer-sign{
            color: #d23f3c;
        }

        .bill-sign{
            color: cadetblue;
        }

        .package-sign{
            color: mediumseagreen;
        }

        .text {
            -webkit-transition: background-size 0.4s ease;
            transition: background-size 0.4s ease;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(62%, transparent), color-stop(0, #fff87e)) center center/0% 75% no-repeat;
            background: linear-gradient(to bottom, transparent 62%, #fff87e 0) center center/0% 75% no-repeat;
            padding: 0 6px 2px 6px;
            cursor: pointer;
            color: rgba(80, 89, 113, 0.7);
            letter-spacing: 0.08rem;
        }
        .text:hover {
            background-size: 100% 100%;
        }
        .text:active {
            background-size: 80% 100%;
        }

        .my{
            margin-left: 150px;
            margin-top: 30px;
            width: 100px;
        }

        #have {
            margin-top: 15px;
            margin-bottom: 15px;
            color: red;
        }
    </style>
    @endsection
    <script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="head-bot container row center-item">
        <img class="icon-head" src="/images/wifi.png" alt="no img">
        <div style="margin-left: 50px">
            <h1 class="header-text">Wifi Packages</h1>
        </div>
    </div>
    <div class="container row center" style="margin-top: 50px;max-width: 1300px">
        <div class="col-md-7 inner">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    Packages Wifi
                </div>
                <div class="card-body">
                    <div class="alert-message" style="color: darkgray">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp; หมายเหตุ : Wifi ของทางหอพักสามารถซื้อได้จากช่องทางนี้เท่านั้น และ 1 คนสามารถซื้อได้เพียง 1 แพ็คเกตเท่านั้น หากต้องการเปลี่ยนแพคเกตต้องรอแพ็คเกตเดิมหมดก่อน หากมีข้อสงสัยโปรดติดต่อนิติบุคคล</p>
                        <hr>
                        <p>เบอร์ติดต่อนิติบุคคล : 081-342XXXX</p>

                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 15px">โปรดเลือก wifi packages @if($have)<p style="color: red;display: inline">( ไม่สามารถซื้อได้ )</p>@endif</h4>
                        @if($have)
                        <p id="have">**คุณมี wifi package ของทางหอพักอยู่แล้ว สามารถดูได้ที่หน้าห้องของฉัน หากมีข้อสงสัยติดต่อนิติบุคคล</p>
                        @endif
                        <form action="{{ route('wifi.store') }}" method="post">
                            @csrf
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios1" value="1" @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    1 วัน ( 100Mbps / 50Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 30 บาท</p>
                            </div>
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios2" value="3" @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios2">
                                    3 วัน ( 100Mbps / 50Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 81 บาท</p>
                            </div>
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios1" value="7" checked @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    7 วัน ( 100Mbps / 50Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 190 บาท</p>
                            </div>
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios1" value="30" @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    30 วัน ( 150Mbps / 80Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 490 บาท</p>
                            </div>
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios1" value="90" @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    90 วัน ( 200Mbps / 120Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 1390 บาท</p>
                            </div>
                            <div class="form-check divider">
                                <input class="form-check-input" type="radio" name="wifi" id="exampleRadios1" value="365" @if($have)disabled @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    365 วัน ( 200Mbps / 120Mbps )
                                </label>
                                <p class="price">&nbsp;&nbsp;&nbsp; ราคา 4490 บาท</p>
                            </div>
                            <input type="hidden" name="room_id" value="{{ $room }}">
                            @if(!$have)
                                <button type="button" class="btn btn-success my" data-toggle="modal" data-target="#wifi" style="width: 100px">ซื้อ</button>
                            @endif

                            <div class="modal fade" id="wifi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ยืนยันสั่งซื้อ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ยืนยันซื้อ packages นี้หรือไม่
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="text-align: center">
                <div class="card-header">
                    My Cash
                </div>
                <div class="card-body" style="font-size: 30px">
                    {{ $cash }} &nbsp;&nbsp;฿
                </div>
            </div>
            <div class="card" style="margin-top: 50px;">
                <div class="card-header" style="text-align: center">
                    จัดการ
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-home"></i>&nbsp;&nbsp;<a class="text" href="{{ route('rooms.show.user',['id' => $room]) }}">ห้องของฉัน</a></li>
                    <li class="list-group-item"><i class="fas fa-exclamation-triangle errer-sign"></i>&nbsp;&nbsp;<a class="text" href="{{ route('user.create.report',['room' => $room]) }}">แจ้งซ่อมและรายงานปัญหา</a></li>
                    @if($bill_this_month)
                        <li class="list-group-item"><i class="fas fa-file-invoice-dollar bill-sign"></i>&nbsp;<a href="{{ route('receipts.show',['receipt' => $room]) }}" class="text">บิลประจำเดือน</a></li>
                    @else
                        <li class="list-group-item"><i class="fas fa-file-invoice-dollar bill-sign"></i>&nbsp;<a href="" style="padding-left: 1rem" class="text">ยังไม่มีบิล</a></li>
                    @endif
                    <li class="list-group-item"><i class="fas fa-box-open package-sign"></i>&nbsp;&nbsp;<a class="text" href="{{ route('room.users.packages',['id' => $room]) }}">ตรวจสอบพัสดุ</a><span class="badge badge-danger">{{ $c }}</span></li>
                    <li class="list-group-item"><i class="fas fa-receipt" style="font-size: 120%"></i>&nbsp;&nbsp;&nbsp;<a class="text" href="{{ route('room.user.statement',['room' => $room]) }}">ประวัติการชำระเงินของฉัน</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endsection
