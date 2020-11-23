@extends('layouts.app')

@section('style')
    <style>
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

        .icon-head{
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .head-bot{
            margin: auto;
            height: 160px;
            border-bottom: solid 1px darkgray;
            max-width: 1300px;
        }

        .center-item{
            justify-content: center;
        }
        .center{
            margin: auto;
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

        .alert-message{
            padding: 20px 20px 0;
            border-right: 1px solid;
            border-bottom: 1px solid;
            border-radius: 0px 26px 26px 26px;
        }

        .my{
            margin-left: 150px;
            margin-top: 30px;
            width: 100px;
        }

        .marg{
            margin-bottom: 7px;
        }
    </style>
    @endsection

@section('content')
    <div class="head-bot container row center-item">
        <img class="icon-head" src="/images/money.png" alt="no img">
        <div style="margin-left: 50px">
            <h1 class="header-text">เติมเงินในระบบ</h1>
        </div>
    </div>

    <div class="container row center" style="margin-top: 50px;max-width: 1300px">
        <div class="col-md-7 inner">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    ระเบียบบังคับ
                </div>
                <div class="card-body">
                    <div class="alert-message" style="color: darkgray">
                        <p>1. การเติมเงินในระบบเพื่อใช้ในเว็บไซต์นี้เท่านั้น ไม่สามารถถอนออกไปได้</p>
                        <p>2. เมื่อเติมเงินในระบบถึงยอดเงินขั้นต่ำ จะได้รับโบนัสเพิ่มเติมตามที่ระบุไว้</p>
                        <p>3. หากมีข้อสงสัยโปรดติดต่อนิติบุคคล</p>
                        <hr>
                        <p>เบอร์ติดต่อนิติบุคคล : 081-3425966</p>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-top: 25px;">
                <div class="card-header">
                    เติมเงิน
                </div>
                <div class="card-body">
                    <form action="{{ route('updateCash') }}" method="post">
                        @csrf
                        <div class="form-check divider marg">
                            <input class="form-check-input" type="radio" name="cash" id="exampleRadios1" value="100">
                            <label class="form-check-label" for="exampleRadios1">
                                100 บาท
                            </label>
                        </div>
                        <div class="form-check divider marg">
                            <input class="form-check-input" type="radio" name="cash" id="exampleRadios2" value="300">
                            <label class="form-check-label" for="exampleRadios2">
                                300 บาท
                            </label>
                        </div>
                        <div class="form-check divider marg">
                            <input class="form-check-input" type="radio" name="cash" id="exampleRadios1" value="530">
                            <label class="form-check-label" for="exampleRadios1">
                                500 บาท <span>+ โบนัส 30 บาท</span>
                            </label>
                        </div>
                        <div class="form-check divider marg">
                            <input class="form-check-input" type="radio" name="cash" id="exampleRadios1" value="1070">
                            <label class="form-check-label" for="exampleRadios1">
                                1,000 บาท <span>+ โบนัส 70 บาท</span>
                            </label>
                        </div>
                        <div class="form-check divider">
                            <input class="form-check-input" type="radio" name="cash" id="exampleRadios1" value="5450">
                            <label class="form-check-label" for="exampleRadios1">
                                5,000 วัน บาท <span>+ โบนัส 450 บาท + บริการล้างแอร์ฟรี 3 ครั้ง</span>
                            </label>
                        </div>
                            <button type="button" class="btn btn-success my" data-toggle="modal" data-target="#cash" style="width: 100px">เติมเงิน</button>

                        <div class="modal fade" id="cash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เติมเงิน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ยืนยันการเติมเงินหรือไม่
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
        </div>
        <div class="col-md-4">
            <div class="card" style="text-align: center">
                <div class="card-header">
                    My Cash
                </div>
                <div class="card-body" style="font-size: 30px">
                    {{ Auth::user()->money }} &nbsp;&nbsp;฿
                </div>
            </div>
        </div>
    </div>
    @endsection
