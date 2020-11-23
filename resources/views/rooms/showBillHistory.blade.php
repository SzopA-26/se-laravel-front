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
    <div class="">
        <div class="">
            <h1 class="text-center">จ่ายบิลออนไลน์</h1>
        </div>
    </div>
    <div class="container row center" style="margin-top: 50px;max-width: 1300px">
        <div class="col-md-8 inner">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    รายละเอียดบิล
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <dl class="row">
                                    <dt class="col-12">Ku Residential</dt>
                                    <dt class="col-12"> พหลโยธิน 34 ซ.พหลโยธิน 34 แยก 11</dt>
                                    <dt class="col-12"> Tel : 095-865-4531</dt>
                                </dl>
                            </div>
                            <div class="col-6 text-left">
                                <dl class="row">
                                    <dt class="col-12">ชื่อ : {{ $user->title }} {{ $user->first_name }}  {{ $user->last_name }}</dt>
                                    <dt class="col-12">ที่อยู่ : {{ $user->address }} </dt>
                                    <dt class="col-12">ห้อง : ตึก {{ $user->room->building->name }} ชั้น {{ $user->room->floor }} เลขห้อง {{ $user->room->number }} </dt>
                                    <dt class="col-12">วันที่แจ้งหนี้ {{ \Carbon\Carbon::parse($show_bill->activated_at)->format('d-m-Y') }} </dt>

                                </dl>

                            </div>
                            <div class="col-6 ">
                                <dl class="row">
                                    <dt class="col-12 ">เลขประจำตัวผู้เสียภาษี : 0016302283835</dt>
                                    <dt class="col-12 ">วันที่ออกบิล : {{ \Carbon\Carbon::parse($show_bill->activated_at)->format('d/m/Y')}} </dt>
                                </dl>
                            </div>
                        </div>
                        <table class="table table">
                            <thead>
                            <tr>
                                <th >รายการ</th>

                                <th class="text-right">จำนวนยูนิต</th>
                                <th class="text-center">ราคา</th>
                                <th >จำนวนเงิน</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th >ค่าไฟ </th>
                                <td class="text-right">{{ $show_bill->electric_unit }}</td>
                                <td class="text-center">{{ $show_bill->room->building->electric_rate }}</td>
                                <td >{{ $show_bill->electric_unit * $show_bill->room->building->electric_rate }}</td>
                            </tr>
                            <tr>
                                <th >ค่าน้ำ</th>
                                <td class="text-right">{{ $show_bill->water_unit }}</td>
                                <td class="text-center">{{ $show_bill->room->building->water_rate }}</td>
                                <td>{{ $show_bill->water_unit * $show_bill->room->building->water_rate }}</td>
                            </tr>
                            <tr>
                                <th>ค่าห้อง</th>
                                <td colspan="2"></td>
                                <td>{{ $show_bill->room_price }}</td>
                            </tr>
                            @if($req->status == 'รอการชำระเงิน')
                                <tr>
                                    <th>ค่ามัดจำ</th>
                                    <td colspan="2"></td>
                                    <td>
                                        {{ $bill->room_price }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th colspan="3">รวม</th>

                                <td>
                                    @if($req->status === 'รอการชำระเงิน')
                                        {{ ($show_bill->room_price)*2 }}
                                    @else
                                        {{ $show_bill->total_price  }}

                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <dl class="row">
                                <dt class="col-12"> วันสุดท้ายที่ต้องชำระ : {{ \Carbon\Carbon::parse($show_bill->activated_at)->addDays(5)->format('d/m/Y') }}</dt>
                                <dt class="col-12"> หากเกินกำหนดแล้ว ท่านจะต้องเสียค่าปรับตามข้อตกลง 200 บาท/วัน</dt>
                            </dl>

                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p class="text-center"> {{ $show_bill->user->title }} {{ $show_bill->user->first_name }} {{ $show_bill->user->last_name }}</p>
                                <p class="text-center">ผู้จัดทำ</p>

                            </div>
                            <div class="col-4">
                                <p class="text-center"> {{ $show_bill->user->title }} {{ $show_bill->user->first_name }} {{ $show_bill->user->last_name }}</p>
                                <p class="text-center">ผู้อนุมัติ</p>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="text-align: center; height: 20rem" >
                <div class="card-header">
                    ประวัติการจ่ายบิล
                </div>
                <div class="card-body table-responsive">
                    <table class="table ">
                        <caption>รายการบิลทั้งหมด</caption>
                        <thead>
                        <tr>
                            <th scope="col">วันที่</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills->sortByDesc('activated_at') as $bill)
                            <tr>

                                <td>{{ \Carbon\Carbon::parse($bill->activated_at)->format('d/m/Y') }}</td>
                                    <td><a href="{{route('rooms.show.billHistory',['id'=> $room->id,'bill'=> $bill->id])}}"><button type="submit" class="btn btn-sm btn-outline-primary">ดูบิล</button></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                    <li class="list-group-item"><i class="fas fa-box-open package-sign"></i><a class="text" href="{{ route('room.users.packages',['id' => $room]) }}">ตรวจสอบพัสดุ</a><span class="badge badge-danger"></span></li>


                </ul>
            </div>
        </div>
    </div>
@endsection
