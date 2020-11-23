@extends('layouts.app')
@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        .input-aligned {
            line-height:34px;
        }
    </style>
@endsection
<script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container justify-content-center">
        <div class="">
            <div class="card" >
                <div class="card-body">
                    <h3 class="card-title text-center">แบบฟอร์มการจองห้องพัก</h3>
                    <form action="{{ route('requests.store') }}" METHOD="POST">
                        @csrf
                        <div  class="container m-md-3" style="padding-top: 2rem">
                            <dl class="row">
                                <dt class="col-sm-2 text-right ">ชื่อ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ Auth::user()->title }}{{ Auth::user()->first_name }}">
                                </dd>
                                <dt class="col-sm-2 text-right">นามสกุล :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ Auth::user()->last_name }}">
                                </dd>


                                <dt class="col-sm-2 text-right">ที่อยุ่ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ Auth::user()->address }}">
                                </dd>

                                <dt class="col-sm-2 text-right">เบอร์โทรศัพท์ :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ Auth::user()->phone_number_1 }}">
                                </dd>

                                <dt class="col-sm-2 text-right">อีเมล :</dt>
                                <dd class="col-sm-9">
                                    <input class="form-control w-50" type="text" disabled value="{{ Auth::user()->email }}">
                                </dd>

                                <dt for="checkin_date" class="col-sm-2 col-form-label text-md-right">วันที่ต้องการย้ายเข้า :</dt>

                                <dd class="col-sm-9">
                                    <input type="date" class="form-control w-50" id="checkin_date" name="checkin_date" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>

                                    @error('checkin_date')
                                    <span class="invalid-feedback" role=" alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </dd>

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="room_id" value="{{ $room["id"] }}" }}>

                            </dl>
                        </div>

                        <h3 class="card-title text-center">ข้อมูลห้อง</h3>
                        <div  class="container m-md-3" style="padding-top: 2rem">
                            <dl class="row">
                                <dt class="col-sm-2 text-right">ที่อยู่ :</dt>
                                <dd class="col-sm-9">{{ $building["address"] }}</dd>

                                <dt class="col-sm-2 text-right">ตึก :</dt>
                                <dd class="col-sm-9">{{ $building["name"] }}</dd>

                                <dt class="col-sm-2 text-right">ชั้น :</dt>
                                <dd class="col-sm-9">{{ $room["floor"] }}</dd>

                                <dt class="col-sm-2 text-right">เลขห้อง :</dt>
                                <dd class="col-sm-9">{{ $room["number"] }}</dd>

                                <dt class="col-sm-2 text-right">แบบห้อง :</dt>
                                <dd class="col-sm-9">{{ $type["name"] }}</dd>

                                <dt class="col-sm-2 text-right">ขนาด :</dt>
                                <dd class="col-sm-9">{{ $type["size"] }} ตร.ม.</dd>

                                <dt class="col-sm-2 text-right">เฟอร์นิเจอร์ :</dt>
                                <dd class="col-sm-9">เตียงคู่ ตู้เย็น ทีวี โต๊ะ เก้าอี้ ตู้เสื้อผ้า</dd>

                                <dt class="col-sm-2 text-right">ราคามัดจำ :</dt>
                                <dd class="col-sm-9">{{ $type["price"] }} บาท</dd>

                                <dt class="col-sm-2 text-right">ราคาเช่าล่วงหน้า :</dt>
                                <dd class="col-sm-9">{{ $type["price"] }} บาท</dd>

                                <dt class="col-sm-2 text-right">ค่าน้ำ :</dt>
                                <dd class="col-sm-9">{{ $building["water_rate"] }} บาทต่อยูนิต</dd>
                                <dt class="col-sm-2 text-right">ค่าไฟ :</dt>
                                <dd class="col-sm-9">{{ $building["electric_rate"] }} บาทต่อยูนิต</dd>

                                <dt class="col-sm-2 text-right">สัญญา :</dt>
                                <dd class="col-sm-9">1 ปี</dd>

                                <dt class="form-check col-sm-2 text-right">
                                    <input class="form-check-input position-static" type="checkbox" id="accept" value="option1" aria-label="..." required>
                                </dt>
                                <dd>
                                    <label for="accept">ยอมรับเงื่อนไข</label>
                                    <a href="#policy" data-toggle="modal" data-taget="#policy" style="color: deepskyblue">
                                        นโยบายความเป็นส่วนตัว</a>

                                </dd>


                            </dl>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#request">ยืนยันการจองห้องพัก</button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการจองห้องพัก</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ยืนยันการส่งรายงานนี้หรือไม่
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

        <!-- Modal -->
        <div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="head" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title te" id="head">นโยบายความเป็นส่วนตัว</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-title text-center">นโยบายคุ้มครองข้อมูลส่วนบุคคลของเว็บไซต์ KU Residential</h3>
                        <section>
                            <div class="text-dark" style="padding-top: 2rem">
                                <h4>ข้อมูลเบื้องต้น</h4>
                                <p>  เราจะทำการเก็บข้อมูลเมื่อคุณเข้าชมเว็บไซต์ของเรา รวมถึงการใช้บริการต่างๆ ตามที่ปรากฏในหน้าเว็บไซต์ เช่น เมื่อมีการทำการนัดหมาย การขอข้อมูล การโพสต์รูปภาพ การส่งข้อคิดเห็น สำหรับการสมัครเพื่อเป็นสมาชิกหรือการใช้บริการต่างๆ อาจมีการขอข้อมูลเพิ่มเติม</p>

                            </div>
                        </section>

                        <section>
                            <div class="text-dark" style="padding-top: 2rem">
                                <h4>ขอบเขตของนโยบายคุ้มครองข้อมูลส่วนบุคคลของ</h4>
                                <p>
                                    นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ใช้ภายใต้เว็บไซต์ Ku Residential รวมถึงบริการอื่นๆ ซึ่งสามารถเข้าถึงได้ภายในแพลทฟอร์มในเว็บไซต์นี้ ทั้งนี้อาจมีการแสดงข้อกำหนดซึ่งเกี่ยวข้องกับนโยบายคุ้มครองข้อมูลส่วนบุคคลเพิ่มเติมในบริการ เพื่อให้คุณอนุมัติก่อนการเข้าถึงบริการนั้นๆ
                                </p>
                                <p>หมายเหตุ : นโยบายส่วนบุคคลนี้จะไม่ใช้กับข้อมูลซึ่งจะได้เปิดเผยหรือทำการส่งไปยัง
                                </p>

                            </div>
                        </section>

                        <section>
                            <div class="text-dark" style="padding-top: 2rem">
                                <h4>ข้อจำกัด</h4>
                                <p>เว็บไซต์ของเราไม่มุ่งหมายเพื่อการใช้งานสำหรับเด็กอายุต่ำกว่า 16 ปี

                                </p>
                            </div>
                        </section>

                        <section>
                            <div class="text-dark" style="padding-top: 2rem">
                                <h4>การปรับปรุงนโยบายคุ้มครองข้อมูลส่วนบุคคล
                                </h4>
                                <p>
                                    การปรับปรุงนโยบายคุ้มครองข้อมูลส่วนบุคคลของอนันดา เพื่อสอดคล้องกับนโยบายคุ้มครองข้อมูลส่วนบุคคลของ EU รวมถึงเพื่อรับรองสิทธิของคุณภายใต้นโยบายคุ้มครองข้อมูลส่วนบุคคลของ Ku Residential
                                    อนันดาอาจทำการแก้ไขเพิ่มเติมเงื่อนไขและข้อกำหนดของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้เป็นครั้งคราว ซึ่งการแก้ไขเพิ่มเติมดังกล่าวถือว่าเป็นส่วนหนึ่งของนโยบายและข้อกำหนดในนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ด้วย
                                    เรายืนยันว่าคุณจะได้รับการแจ้งให้ทราบหากมีการการปรับปรุงหรือแก้ไขส่วนสำคัญในนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ และ Ku Residential จะโพสต์ไปยังเว็บไซต์ในกรณีที่มีการปรับปรุงแก้ไขนโยบาย ก่อนที่การปรับปรุงดังกล่าวจะมีผลบังคับ
                                </p>

                            </div>
                        </section>

                        <section>
                            <div class="text-dark" style="padding-top: 2rem">
                                <h4>ประเภทของข้อมูลที่จัดเก็บ

                                </h4>

                                <ul>
                                    <li>
                                        <p>
                                            <strong>ข้อมูลส่วนบุคคล</strong>
                                            หมายถึง ข้อมูลที่เกี่ยวข้องกัยการระบุตัวตนของบุคคลธรรมดา บุคคลธรรมดาที่ระบุตัวตนได้ หมายความถึง บุคคลหนึ่งซึ่งสามารถถูกระบุตัวตนได้โดยเฉพาะเจาะจงโดยตรงหรือโดยอ้อม โดยอ้างอิงจากตัวบ่งชี้ใดๆ
                                        </p>

                                    </li>
                                    <li>
                                        <p>
                                            <strong>ข้อมูลซึ่งไม่ใช่ข้อมูลส่วนบุคคล</strong>
                                            หมายถึง ข้อมูลที่ไม่เกี่ยวข้องต่อบุคคลธรรมดาที่ระบุตัวตนได้
                                        </p>

                                    </li>
                                    <li>
                                        <p>
                                            <strong>ข้อมูลระบบ</strong>
                                            หมายถึง ข้อมูลที่เกี่ยวข้องกัยการระบุตัวตนของบุคคลธรรมดา บุคคลธรรมดาที่ระบุตัวตนได้ หมายความถึง บุคคลหนึ่งซึ่งสามารถถูกระบุตัวตนได้โดยเฉพาะเจาะจงโดยตรงหรือโดยอ้อม โดยอ้างอิงจากตัวบ่งชี้ใดๆ
                                        </p>

                                    </li>
                                    <p>ข้อมูลของคุณดังต่อไปนี้เป็นข้อมูลที่เราจัดเก็บ</p>
                                    <ul>
                                        <li>ชื่อ</li>
                                        <li>อีเมล</li>
                                        <li>ที่อยู่</li>
                                        <li>เบอร์โทรศัพท์</li>
                                        <li>เพศ</li>
                                        <li>วันเกิด</li>
                                        <li>หมายเลขบัตรประชาชน</li>

                                    </ul>


                                </ul>



                            </div>
                        </section>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
