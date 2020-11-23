@extends('layouts.app')

@section('style')
    <style>
        .card-adapt {
            margin: 25px 30px 25px 20px;
        }

        .card-bot {
            padding: 0.5rem 1.25rem 0.5rem;
        }

        .inline{
            display: flex;
            height: 80px;
        }

        .room-detail{
            width: 13%;
            padding: 15px 15px 5px;
            border-right: solid 1px #999da0;
        }

        .package-detail {
            width: 100%;
            padding: 0.5rem 15px;
        }

        .date{
            margin-top: -30px;
            float: right;
        }

        .show-image{
            position: absolute;
            right: 40px;
            top: 15px;
        }

        .icon-con{
            position: absolute;
            right: 160px;
            top: 15px;
        }

        .allp{
            margin-right: 15px;
            width: 150px;
        }
    </style>
    @endsection

@section('content')
    <div class="container align-content-center upper">

        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h1 class="card-title">พัสดุทั้งหมด</h1>


                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('packages.history') }}"><button class="btn btn-outline-info allp">ตรวจสอบประวัติพัสดุ</button></a>
                        <a href="{{ route('packages.create') }}"><button class="btn btn-outline-success"><i class="fas fa-plus" ></i> เพิ่มพัสดุ</button></a>
                    </div>

                </div>

            </div>


            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        @php($i=1)
                        @foreach($packages as $package)
                        <div>
                            <div class="card card-adapt">
                                <div class="card-body card-bot">
                                    <button class="btn btn-info show-image" data-toggle="modal" data-target="#image{{ $i }}"><i class="fas fa-gift" style="margin-right: 5px"></i>ดูรูปพัสดุ</button>
                                    <a class="icon-con btn btn-outline-info" style="color: #0080fe;" href="{{ route('package.confirm',['room' => $package->room->id, 'package' => $package->id]) }}">รับพัสดุแล้ว</a>
                                    <div class="inline">
                                        <div class="room-detail">
                                            <h5>ตึก  : {{ $package->room->building->name }}</h5>
                                            <h5 style="margin-bottom: 0">ห้อง : {{ $package->room->number }}</h5>
                                        </div>
                                        <div class="package-detail">
                                            <p>ชื่อผู้รับพัสดุ : {{ $package->recipient }} </p>
                                            <p>รายละเอียด : {{ $package->detail }}</p>
                                            <p class="date" style="color: #808588">{{ $package->created_at }}</p>
                                        </div>
                                    </div>
                                    <hr style="margin: 0.4rem 0">
                                    <p style="margin-bottom: 0.1rem;color: #808588">ผู้รับผิดชอบ :  {{ $package->user->first_name }}    {{ $package->user->last_name }}</p>
                                </div>
                            </div>
                        </div>

                            <div class="modal fade bd-example-modal-lg" id="image{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="width: auto">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">รูปพัสดุ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img style="width: 600px" src="{{ $package->image_path }}" alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php($i++)
                            @endforeach

                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>


    </div>
    @endsection
