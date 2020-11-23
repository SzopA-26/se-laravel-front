@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        .type-button {
            margin-left: 10px;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container justify-content-center">
        <div class="card" style="height: 40rem;">
            <div class="card-header">
             <h3 class="text-center"> ดูห้องทั้งหมด {{ $selected_type["id"] }} </h3>
            </div>
            <div class="card-header">
                <div class="form-row" style="padding-top: 1rem">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="building">ตึก </label>
                            <select class="custom-select" id="building" onchange="location = this.value">
                                <option selected disabled>เลือกตึก</option>
                                @foreach($buildings as $b)
                                    <option
                                        @isset($building)
                                            @if($b["id"] == $building["id"])
                                                selected
                                            @endif
                                        @endisset
                                        value="{{ route('rooms.index.building', ['type' => $selected_type["id"], 'building' => $b["id"]]) }}">
                                        ตึก {{ $b["name"] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="floor">ชั้น </label>
                            <select class="custom-select" id="floor" onchange="location = this.value"
                            @empty($building)
                                disabled
                            @endempty
                            >
                                <option selected disabled>เลือกชั้น </option>
                                @isset($building)
                                @for($i=1; $i <= $building["total_floor"]; $i++)
                                    <option
                                        @isset($selected_floor)
                                            @if($i == $selected_floor)
                                            selected
                                            @endif
                                        @endisset
                                        value="{{ route('rooms.index.building.floor', ['type' => $selected_type["id"], 'building' => $building["id"], 'floor' => $i]) }}"
                                    >ชั้น {{ $i }}</option>
                                @endfor
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-4" style="padding-top: 2rem">
                            <a type="button" class="btn btn-outline-primary" href="{{ route('rooms.index', ['type' => $selected_type["id"]]) }}">ล้าง</a>
                        </div>
                        @foreach($types as $type)
                            <a class="btn btn-outline-primary type-button
                           @if($type["id"] == $selected_type["id"])
                                active
                            @endif
                                " href="{{ route('rooms.index' ,[ 'type' => $type["id"] ]) }}" style="margin-top: 10px">{{ $type["name"] }}</a>
                        @endforeach

                    </div>


                </div>


            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-center ">
                    <thead>
                    <tr>
                        <th scope="col">ตึก</th>
                        <th scope="col">ชั้น</th>
                        <th scope="col">ห้อง</th>
                        <th scope="col">ขนาด(ตร.ม.)</th>
                        <th scope="col">ประเภท</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">ห้องว่าง</th>
                        @endif
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                            @if(auth()->check())
                                @if(auth()->user()->role == 'user' && $room["available"] == 'no')
                                    @continue
                                @endif
                                <tr>
                                    @foreach($buildings as $building)
                                        @if($building["id"] == $room["building_id"])
                                            <td>{{ $building["name"] }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $room["floor"] }}</td>
                                    <td>{{ $room["number"] }}</td>
                                    <td>{{ $type["size"] }}</td>
                                    <td>{{ $type["name"] }}</td>
                                    @if(auth()->user()->isAdmin())
                                        <td
                                        @if($room["available"] == 'yes')
                                            style="color: green"
                                        @else
                                            style="color: red"
                                        @endif
                                        >{{ $room->available }}</td>
                                        <td><a href="{{ route("rooms.show.staff", ['id' => $room["id"]]) }}"><button type="button" class="btn btn-outline-primary">แสดง</button></a></td>
                                    @else
                                        <td><a href="{{ route("rooms.show",['room' => $room["id"]]) }}"><button type="button" class="btn btn-outline-success">แสดง</button></a></td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
