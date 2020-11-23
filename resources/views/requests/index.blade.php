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

@section('content')
    <div class="container justify-content-center">
        <div class="card" style="height: 40rem;">
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
                                        value="{{ route('requests.index.building', ['type' => $selected_type["id"], 'building' => $b["id"]]) }}">
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
                                    @for($i=1; $i <= $building->total_floor; $i++)
                                        <option
                                            @isset($selected_floor)
                                            @if($i == $selected_floor)
                                            selected
                                            @endif
                                            @endisset
                                            value="{{ route('requests.index.building.floor', ['type' => $selected_type->id, 'building' => $building->id, 'floor' => $i]) }}"
                                        >ชั้น {{ $i }}</option>
                                    @endfor
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-4" style="padding-top: 2rem">
                            <a type="button" class="btn btn-outline-primary" href="{{ route('requests.index', ['type' => $selected_type]) }}">ล้าง</a>
                        </div>
                    </div>


                </div>


            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">ตึก</th>
                        <th scope="col">ชั้น</th>
                        <th scope="col">ห้อง</th>
                        <th scope="col">ขนาด(ตร.ม.)</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">สถานะ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $req)
                        @if($req->status == 'สำเร็จ')
                            @continue
                        @endif
                        @isset($building)
                            @if($building->id != $req->room->building_id)
                                @continue
                            @endif
                        @endisset
                        @isset($selected_floor)
                            @if($selected_floor != $req->room->floor)
                                @continue
                            @endif
                        @endisset
                        <tr>
                            <td>{{ $req->room->building->name }}</td>
                            <td>{{ $req->room->floor }}</td>
                            <td>{{ $req->room->number }}</td>
                            <td>{{ $req->room->type->size }}</td>
                            <td>{{ $req->room->type->name }}</td>
                            @if($req->status == 'รอการยืนยัน')
                                <td style="color: orange">รอการยืนยัน</td>
                            @else
                                <td style="color: blue">รอการชำระเงิน</td>
                            @endif
                            <td><a href="{{ route("requests.show", ['request' => $req->id]) }}" type="button" class="btn btn-outline-primary">แสดง</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
