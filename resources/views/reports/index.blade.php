@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }

    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container justify-content-center">
        <div class="card " style="height: 40rem">
            <div class="card-header ">
                <div class="text-center">
                    <h3>รายงานและแจ้งซ่อม</h3>
                </div>
{{--                <form action="{{ route('reports.index.search') }}" method="GET">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-2 mb-3">--}}
{{--                            <label for="building">ตึก</label>--}}
{{--                            <select class="custom-select" id="building" onchange="location = this.value">--}}
{{--                                <option selected disabled>เลือกตึก</option>--}}
{{--                                @foreach($buildings as $b)--}}
{{--                                    <option--}}
{{--                                        @isset($building)--}}
{{--                                        @if($b['id'] == $building['id'])--}}
{{--                                        selected--}}
{{--                                        @endif--}}
{{--                                        @endisset--}}
{{--                                        value="{{ route('reports.index.building', ['building' => $b['id']]) }}">--}}
{{--                                        ตึก {{ $b['name'] }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-2 mb-3">--}}
{{--                            <label for="floor">ชั้น</label>--}}
{{--                            <select class="custom-select" id="floor" onchange="location = this.value"--}}
{{--                                @empty($building)--}}
{{--                                    disabled--}}
{{--                                @endempty--}}
{{--                            >--}}
{{--                                <option selected disabled>เลือกชั้น </option>--}}
{{--                                @isset($building)--}}
{{--                                    @for($i=1; $i <= $building['total_floor']; $i++)--}}
{{--                                        <option--}}
{{--                                            @isset($floor)--}}
{{--                                            @if($i == $floor)--}}
{{--                                            selected--}}
{{--                                            @endif--}}
{{--                                            @endisset--}}
{{--                                            value="{{ route('reports.index.building.floor', ['building' => $building['id'], 'floor' => $i]) }}"--}}
{{--                                        >ชั้น {{ $i }}</option>--}}
{{--                                    @endfor--}}
{{--                                @endisset--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3 mb-3" style="padding-top: 2rem">--}}
{{--                            <a href="{{ route('reports.index') }}"><button type="button" class="btn btn-outline-primary">ล้าง</button></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}




                <ul class="nav nav-tabs card-header-tabs"  id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="true">แจ้งเรื่องร้องทุกข์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="repair-tab" data-toggle="tab" href="#repair" role="tab" aria-controls="repair" aria-selected="false">แจ้งซ่อมภายใน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#save" role="tab" aria-controls="save" aria-selected="false">รายการที่บันทึก</a>
                    </li>
                </ul>
            </div>

            <div class="card-body table-responsive ">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">เรื่อง</th>
                                <th scope="col">เวลาที่ส่ง</th>
                                <th scope="col">ตึก</th>
                                <th scope="col">ห้อง</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($reports)
                                    @foreach( $reports as $report)
                                        <tr>
                                            <td>{{ $report['title']}}</td>
                                            <td>{{ date('d-m-Y', strtotime($report['created_at'])) }}</td>
                                            @foreach($rooms as $room)
                                                @if($room["id"] == $report["room_id"])
                                                    @foreach($buildings as $building)
                                                        @if($building["id"] == $room["building_id"])
                                                            <td>{{ $building["name"] }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $room['number'] }}</td>
                                                @endif
                                            @endforeach
                                            <td>
                                                <a href="{{route('reports.edit',['report' => $report['id']])}}">
                                                    <button type="submit" class="btn btn-outline-primary">แสดง</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class=" text-black-50" colspan="3">
                                            ไม่มีเรื่องร้องทุกข์

                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>


                    </div>
                    <div class="tab-pane fade table-responsive" id="repair" role="tabpanel" aria-labelledby="repair-tab">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">เรื่อง</th>
                                <th scope="col">เวลาที่ส่ง</th>
                                <th scope="col">ตึก</th>
                                <th scope="col">ห้อง</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($repairs)
                                    @foreach( $repairs as $repair)
                                        <tr>
                                            <td>{{ $repair['title']}}</td>
                                            <td>{{ date('d-m-Y', strtotime($repair['created_at'])) }}</td>
                                            @foreach($rooms as $room)
                                                @if($room["id"] == $repair["room_id"])
                                                    @foreach($buildings as $building)
                                                        @if($building["id"] == $room["building_id"])
                                                            <td>{{ $building["name"] }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $room['number'] }}</td>
                                                @endif
                                            @endforeach
                                            <td>
                                                <a href="{{route('reports.edit',['report' => $repair['id']])}}">
                                                    <button type="submit" class="btn btn-outline-primary">แสดง</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class=" text-black-50" colspan="3">
                                            ไม่มีเรื่องแจ้งซ่อม
                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane fade table-responsive" id="save" role="tabpanel" aria-labelledby="repair-tab">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">เรื่อง</th>
                                <th scope="col">เวลาที่ส่ง</th>
                                <th scope="col">ตึก</th>
                                <th scope="col">ห้อง</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($saved)
                                @foreach( $saved as $save)
                                    <tr>
                                        <td>{{  $save['title']}}</td>
                                        <td>{{  date('d-m-Y', strtotime($save['created_at'])) }}</td>
                                        @foreach($rooms as $room)
                                            @if($room["id"] == $save["room_id"])
                                                @foreach($buildings as $building)
                                                    @if($building["id"] == $room["building_id"])
                                                        <td>{{ $building["name"] }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $room['number'] }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <a href="{{route('reports.edit',['report' => $save['id']])}}">
                                                <button type="submit" class="btn btn-outline-primary">แสดง</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td class=" text-black-50" colspan="3">
                                        ไม่มีเรื่องแจ้งซ่อม
                                    </td>
                                </tr>

                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection
