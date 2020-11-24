@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        #myCarousel .list-inline {
            white-space:nowrap;
            overflow-x:auto;
        }

        #myCarousel .carousel-indicators {
            position: static;
            left: initial;
            width: initial;
            margin-left: initial;
        }

        #myCarousel .carousel-indicators > li {
            width: initial;
            height: initial;
            text-indent: initial;
        }

        #myCarousel .carousel-indicators > li.active img {
            opacity: 0.7;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container ">
        <div class="card bg-secondary" >
            <div class="card-header text-white">
                <h1> ตึก {{ $building["name"] }} ชั้น {{ $room["floor"] }} ห้อง {{ $room["number"] }}</h1>
            </div>
            <div class="card-body">
                <div class="container py-2">

                </div>
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-8"  id="slider">
                            <div id="myCarousel" class="carousel slide shadow">
                                <!-- main slider carousel items -->

                                <div class="carousel-inner">
                                    @foreach($roomImages as $roomImage)
                                    <div class="{{ $loop->first ? 'active' : '' }} carousel-item" data-slide-number="{{ $loop->index }}">
                                        <img src="{{ $roomImage["image_path"] }}" class="img-fluid">
                                    </div>
                                    @endforeach
                                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <!-- main slider carousel nav controls -->

                                <ul class="carousel-indicators list-inline mx-auto border px-2">
                                    @foreach($roomImages as $roomImage)
                                    <li class="list-inline-item active">
                                        <a id="carousel-selector-0" class="selected" data-slide-to="{{ $loop->index }}" data-target="#myCarousel">
                                            <img src="{{ $roomImage['image_path'] }}" class="img-fluid">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="card" style="height: 21rem">
                                <div class="card-header">
                                    <h2>รายละเอียด</h2>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th scope="row">ห้องประเภท</th>
                                            <td> {{ $type["name"] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ขนาด</th>
                                            <td>{{ $type["size"] }} ตร.ม</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">รายเดือน</th>
                                            <td>{{ $type["price"] }}  บาท</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ค่าไฟ</th>
                                            <td>{{ $building["electric_rate"] }}  บาทต่อยูนิต</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ค่าน้ำ</th>
                                            <td>{{ $building["water_rate"] }}  บาทต่อยูนิต</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="row">
        @if($users)
            @foreach($users as $user)
                    <div class="col-4">
                        <div style="padding-top: 1rem">
                            <div class="card text-dark border-primary">
                                <div class="card-body">
                                    <div>
                                        <label >ชื่อ : {{ $user["title"] }} {{ $user["first_name"] }} {{ $user["last_name"] }}</label>
                                    </div>
                                    <div>
                                        <label >ที่อยู่ :</label>
                                        <label > {{ $user["address"] }}</label>
                                    </div>
                                    <div>
                                        <label >Email :</label>
                                        <label >{{ $user["email"] }}</label>
                                    </div>
                                    <div>
                                        <label >เบอร์ติดต่อ :</label>
                                        <label >{{ $user["phone_number_1"] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
        </div>
    </div>

@endsection
