@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }

        #detail {
            height: 200px;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container align-content-center">
        <div class="card ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs"  id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">แจ้งเรื่องร้องทุกข์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">แจ้งซ่อมภายใน</a>
                    </li>
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>--}}
                    {{--                    </li>--}}
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" >
                            <form action="{{ route('reports.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <h1 class="card-title">แบบฟอร์มแจ้งเรื่องร้องทุกข์</h1>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="head">เรื่อง</label>
                                                <input type="text" class="form-control" id="head" name="title" required>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top: 1rem">
                                            <div class="col-md-8">
                                                <label for="detail">รายละเอียด</label>
                                                <textarea class="form-control" id="detail" rows="3" name="detail"></textarea>
                                            </div>
                                        </div>
                                        <h4 style="margin-top: 30px">ห้องที่จะรายงาน</h4>
                                        <div class="form-row" style="padding-top: 1rem">
                                            <div class="col-md-2 mb-3">
                                                <label for="building">ตึก</label>
                                                <select class="custom-select" id="building" name="building_name" required>
                                                    <option selected disabled value="">เลือกตึก</option>
                                                    <option value="A">ตึก A</option>
                                                    <option value="B">ตึก B</option>
                                                    <option value="C">ตึก C</option>

                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="floor">ชั้น</label>
                                                <select class="custom-select" id="floor" name="building_floor" required>
                                                    <option selected disabled value="">เลือกชั้น</option>
                                                    <option value="1">ชั้น 1</option>
                                                    <option value="2">ชั้น 2</option>
                                                    <option value="3">ชั้น 3</option>
                                                    <option value="4">ชั้น 4</option>
                                                    <option value="5">ชั้น 5</option>
                                                    <option value="6">ชั้น 6</option>
                                                    <option value="7">ชั้น 7</option>
                                                    <option value="8">ชั้น 8</option>
                                                    <option value="9">ชั้น 9</option>

                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid state.
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="numRoom">เลขห้อง</label>
                                                <input type="text" class="form-control" id="numRoom" name="room_number" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="room_id" value="{{ $room_id }}" >
                                        <p style="color: #808588">* ประวัติการรายงานของท่าน จะถูกเก็บไว้เป็นความลับ</p>
                                    </div>

                                </div>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#report">รายงาน</button>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ยืนยันรายงาน</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ยืนยันการส่ง รายงานนี้หรือไม่
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>


                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card" >
                            <form action="{{ route('reports.repair.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <h1 class="card-title">แบบฟอร์มแจ้งซ่อม</h1>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="head">สิ่งที่ต้องการซ่อม</label>
                                                <input type="text" class="form-control" id="head" name="title" required>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top: 1rem">
                                            <div class="col-md-8">
                                                <label for="detail">รายละเอียด</label>
                                                <textarea class="form-control" id="detail" rows="3" name="detail" required></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="room_id" value="{{ $room_id }}" >
                                    </div>


                                </div>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#repair">ส่งคำขอแจ้งซ่อม</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="repair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ยืนยันแจ้งซ่อม</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ยืนยัน ส่งเรื่องแจ้งซ่อมหรือไม่
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </form>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')


@endsection

