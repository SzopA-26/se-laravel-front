@extends('layouts.app')
@section('style')
    <style>
        /*.upper {*/
        /*    margin-top: 50px;*/
        /*}*/
        .row {
            margin: 50px 0;
        }

        label {
            margin-bottom: 20px;
        }

        #detail {
            height: 200px;
        }
    </style>
    @endsection

@section('content')

    <div class="container align-content-center upper">

        <div class="card ">
            <div class="card-header">
                <h1 class="card-title">แบบฟอร์มแจ้งพัสดุ</h1>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form  class="md-form" method="post" action="{{ route('packages.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="card" >
                                <div class="card-body">
                                    <div class="container">
                                        <div class="form-row" style="padding-top: 1rem">
                                            <div class="col-md-2 mb-3">
                                                <label for="building">คำนำหน้า</label>
                                                <select class="custom-select" id="building" name="title" required>
                                                    <option selected disabled value="">เลือกคำนำหน้า</option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นางสาว">นางสาว</option>

                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="numRoom">ชื่อจริง</label>
                                                <input type="text" class="form-control" id="numRoom" name="first_name" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="numRoom">นามสกุล</label>
                                                <input type="text" class="form-control" id="numRoom" name="last_name" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                        </div>
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
                                                <label for="numRoom">เลขห้อง</label>
                                                <input type="text" class="form-control" id="numRoom" name="room_number" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8 form-group">
                                                <label for="detail">รายละเอียด และ หมายเหตุ</label>
                                                <textarea class="form-control" id="detail" rows="3" name="detail"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="image">รูปพัสดุ</label>
                                            <input class="form-control" data-preview="#preview" type="file" name="image" onchange="loadFile(event)">
                                            <img style="width: 330px;height: 250px;margin-top: 30px" id="preview" src="" alt="">
                                        </div>

                                    </div>

                                </div>
                                <button type="submit" class="btn btn-outline-success">เพิ่มพัสดุ</button>

                            </div>

                        </form>


                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>


    </div>
    @endsection

@section('script')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    @endsection
