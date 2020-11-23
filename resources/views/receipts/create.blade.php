@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }

        .h-set {
        }

        .inner{
            margin: 7px;
            padding: 7px 7px 0;
        }

        p {
            margin-bottom: 0.3rem;
        }

        .scroll {
            overflow: auto;
            height: 400px;
        }

        .numberf{
            position: absolute;
            right: 30px;
            top: 10px;
            font-weight: bold;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container">
        <div class="card">
            <h1 class="text-center" style="margin: 20px 0;">แบบฟอร์มออกบิล</h1>
            <hr>
            <div class="card-body row">

                <div class="col-md-6" style="border-right: solid 1px lightgray">
                    <div class="card">
                    <div class="card-header">
                        <h3>
                            ตึก {{ $bill->room->building->name }} ชั้น {{ $bill->room->floor }} ห้อง {{ $bill->room->number }}
                        </h3>
                    </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('receipts.store') }}">
                                <div class="container-fluid">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="" for="roomPrice">ค่าห้อง</label>
                                            <input type="number" class="form-control w-50" id="roomPrice" min="0" name="price" value="{{ $bill->room_price }}" data-bind="value:replyNumber"/>
                                        </div>
                                    </div>
                                    <div class=" form-group row" >
                                        <div class="col-md-4">
                                            <label for="roomPrice">ยูนิตไฟ</label>
                                            <input type="number" class="form-control w-50" id="roomPrice" min="0" name="e_unit" value="{{ $bill->electric_unit }}" data-bind="value:replyNumber" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="roomPrice">ราคาต่อยูนิต</label>
                                            <p> {{ $bill->room->building->electric_rate }} บาท</p>
                                        </div>

                                        <input type="hidden" name="bill_id" value="{{ $bill->id }}">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="roomPrice">ยูนิตน้ำ</label>
                                            <input type="number" class="form-control w-50" id="roomPrice" min="0" name="w_unit" value="{{ $bill->water_unit }}" data-bind="value:replyNumber" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="roomPrice">ราคาต่อยูนิต</label>
                                            <p> {{ $bill->room->building->water_rate }} บาท</p>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-outline-success w-100">ออกบิล</button>

                            </form>

                        </div>



                    </div>


            </div>
        </div>
            <div class="col-6 scroll">

                <div class="card h-set">
                    <div class="card-header" style="text-align: center">
                        รายงานของห้อง
                        <div>@if($reports != null) {{ $reports->count() }} รายงาน@endif</div>
                    </div>
                    @if($reports === null)
                        <div>
                            <h3 style="margin-top: 30px">No report</h3>
                        </div>
                    @elseif($reports->count() === 0)
                        <div class="text-center">
                            <h3 style="margin-top: 30px">No report</h3>
                        </div>
                    @else
                        @php
                            $i = 1
                        @endphp
                        @foreach($reports as $report)
                            @if($report->type === 'รายงาน')
                            <div class="card inner row">
                                <div style="text-align: left;font-size: 14px">
                                    <p style="color: #808588;margin-bottom: 0">ผู้แจ้ง : ไม่ระบุ</p>
                                    <p class="numberf">{{ $i }}</p>
                                </div>
                                <hr style="margin: 0.3rem">
                                <div style="text-align: left;padding-left: 30px">
                                    <p>เรื่อง : {{ $report->title }}</p>
                                    <p>{{ $report->detail }}</p>
                                </div>
                            </div>
                                @php( $i++ )
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
