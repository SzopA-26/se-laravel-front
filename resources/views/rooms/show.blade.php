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
        <div class="card border-warning" >
            <div class="card-header">
                <h1> ตึก {{ $building["name"] }} ชั้น {{ $room["floor"] }} ห้อง {{ $room["number"] }}</h1>
            </div>
            <div class="card-body">
                <div class="container py-2">
                    <div class="row ">
                        <div class="col-lg-8"  id="slider">
                            <div id="myCarousel" class="carousel slide shadow">
                                <!-- main slider carousel items -->

                                <div class="carousel-inner">
                                    @foreach($room_images as $roomImage)
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
                                    @foreach($room_images as $roomImage)
                                        <li class="list-inline-item active">
                                            <a id="carousel-selector-0" class="selected" data-slide-to="{{ $loop->index }}" data-target="#myCarousel">
                                                <img src="{{ $roomImage["image_path"] }}" class="img-fluid">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="card border-primary" style="height: 21rem">
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
                    <!--/main slider carousel-->
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border-success">
                                <div class="card-header">
                                    <h3>สิ่งอำนวยความสะดวก</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 > สิ่งอำนวยความสะดวก ภายในห้อง</h5>
                                            <div class="container" style="padding-top: 1rem">
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> เตียงคู่</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> ตู้เย็น</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> เครื่องปรับอากาศ</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> โชฟา</p>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <h5> สิ่งอำนวยความสะดวก ภายในอาคาร</h5>
                                            <div class="container" style="padding-top: 1rem">
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> ลิฟท์</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> ที่จอดรถ</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> สระว่ายน้ำ</p>
                                                <p ><i class="fas fa-check-circle" style="color: #1c7430"></i> ฟิตเนส</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-header">
                                    <h3>ติดต่อสอบถาม</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p class="col-12">เบอร์โทรศัพท์ : 095-865-4531</p>
                                        <p class="col-12">Email : Gomin.p@ku.th</p>
                                        <p class="col-12">Line ID : teenoi603</p>

                                    </div>


                                </div>
                            </div>
                            <div style="padding-top: 2rem;">
                                <a href="{{ route('requests.create',[ 'room' => $room["id"] ] )}}"><button type="button"   class="btn btn-outline-success w-100">จองห้อง</button></a>
                            </div>


                        </div>
                    </div>

                </div>





            </div>

        </div>

    </div>
@endsection
