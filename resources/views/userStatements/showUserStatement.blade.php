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
            width: 120px;
            height: 120px;
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

        .time{
            position: absolute;
            right: 30px;
        }

        .slot{
            padding: 0.75rem;
            margin: 20px;
            border-color: seagreen;
        }

        .filter{
            margin: auto;
            margin-top: 20px;
        }

        .dateshow{
            margin: auto;
            margin-top: 15px;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="head-bot container row center-item">
        <img class="icon-head" src="/images/bill.png" alt="no img">
        <div style="margin-left: 50px">
            <h1 class="header-text">ประวัติการชำระเงิน</h1>
        </div>
    </div>
    <div class="container row center" style="margin-top: 50px;max-width: 1300px">
        <div class="col-md-8 inner">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    ประวัติการชำระเงินของฉัน
                </div>
                <div class="card-body">
                    <div class="alert-message" style="color: darkgray">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp; หมายเหตุ : ประวัติการชำระเงินได้แก่ การซื้อ wifi package และการจ่ายบิล หากมีข้อสงสัยติดต่อนิติบุคคล</p>
                        <hr>
                        <p>เบอร์ติดต่อนิติบุคคล : 081-342XXXX</p>

                    </div>
                </div>

                <div class="filter">
                    <form action="{{ route('room.statement.day',['room' => $room]) }}" method="post">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <h4>เริ่ม : </h4>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInput">Name</label>
                                <input type="date" class="form-control mb-2" id="inlineFormInput" placeholder="start date" name="start">
                            </div>
                            <div class="col-auto">
                                <h4>ถึง : </h4>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInput">Name</label>
                                <input type="date" class="form-control mb-2" id="inlineFormInput" name="end">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </div>
                            @if($start_date != null)
                                <div class="col-auto">
                                    <a href="{{ route('backToAll',['room' => $room]) }}" class="btn btn-outline-primary mb-2">See All</a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="card" style="margin: 1.25rem;margin-top: 0">
                    @if($start_date != null)
                    <p class="dateshow">{{ $start_date }} ถึง {{ $end_date }}</p>
                    @endif
                    <div class="card-body">
                        @foreach($statements as $statement)
                        <div class="card card-body slot">
                            <div style="display: flex;margin: 0 30px">
                                <h5><strong>{{$statement->price}} บาท</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>ประเภท &nbsp;( {{ $statement->detail }} )</small></h5>
                                <div class="time">
                                    <p>{{ $statement->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="text-align: center">
                <div class="card-header">
                    My Cash
                </div>
                <div class="card-body" style="font-size: 30px">
                    {{ $user->money }} &nbsp;&nbsp;฿
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
                    <li class="list-group-item"><i class="fas fa-wifi wifi-sign"></i>&nbsp;&nbsp;&nbsp;<a class="text" href="{{ route('room.user.wifi', ['room' => $room]) }}">ซื้อ wifi package</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
