@extends('layouts.app')

@section('style')
    <style>
        .head-bot{
            margin: auto;
            height: 160px;
            border-bottom: solid 1px darkgray;
            max-width: 1300px;
        }

        .icon-head{
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

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

        .center-item{
            justify-content: center;
        }

        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            background: #111845a6;
            box-sizing: border-box;
            overflow: hidden;
            box-shadow: 0 20px 50px rgb(23, 32, 90);
            border: 2px solid #2a3cad;
            color: white;
            padding: 20px;
            margin-top: 60px;
        }

        .box:before{
            content: '';
            position:absolute;
            top:0;
            left:-100%;
            width:100%;
            height:496px;
            background: rgba(255,255,255,0.1);
            transition:0.5s;
            pointer-events: none;
        }

        .box:hover:before{
            left:-50%;
            transform: skewX(-5deg);
        }


        .box .content{
            position:absolute;
            top:15px;
            left:15px;
            right:15px;
            bottom:15px;
            border:1px solid #f0a591;
            padding:20px;
            text-align:center;
            box-shadow: 0 5px 10px rgba(9,0,0,0.5);

        }

        .box span{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            box-sizing: border-box;

        }

        .box span:nth-child(1)
        {
            transform:rotate(0deg);
        }

        .box span:nth-child(2)
        {
            transform:rotate(90deg);
        }

        .box span:nth-child(3)
        {
            transform:rotate(180deg);
        }

        .box span:nth-child(4)
        {
            transform:rotate(270deg);
        }

        .box span:before
        {
            content: '';
            position: absolute;
            width:100%;
            height: 2px;
            background: #50dfdb;
            animation: animate 4s linear infinite;
        }

        @keyframes animate {
            0% {
                transform:scaleX(0);
                transform-origin: left;
            }
            50%
            {
                transform:scaleX(1);
                transform-origin: left;
            }
            50.1%
            {
                transform:scaleX(1);
                transform-origin: right;

            }

            100%
            {
                transform:scaleX(0);
                transform-origin: right;

            }

        }

        .card-border{
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
    </style>
    @endsection

@section('content')
    <div class="head-bot container row center-item">
        <div class="head-bot container row center-item">
            <div style="margin-left: 50px">
                <h1 class="header-text">My New Roommate</h1>
            </div>
        </div>
        <div class="box">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <div class="content">
                <h2>Invited Your Friend </h2>
                <div class="card-border" style="margin: 30px">
                    โปรดใส่ Email ของผู้ที่ต้องการเชิญ
                </div>
                @if($result != null)
                    <div style="margin: 30px;color: @if(strpos($result,'สำเร็จ'))greenyellow @else darkred @endif">
                        *{{ $result }}*
                    </div>
                @endif
                <form method="post" action="{{ route('sendInvite',['room' => $room->id]) }}" style="margin-top: @if($result != null)20px @else 60px @endif">
                    @csrf
                    <div class="mb-3">
                        <label for="validationDefault01">Email</label>
                        <input type="text" class="form-control" id="validationDefault01" name="email" required @if($room->users->count() >= $room->type->capacity) disabled @endif>
                    </div>
                    @if($room->users->count() >= $room->type->capacity)
                        <div style="margin: 30px;color: darkred">
                            จำนวนสมาชิกในห้องของคุณเต็มแล้ว ({{ $room->type->capacity }} คน) ไม่สามารถเพิ่มได้หากมีสมาชิกย้ายออกโปรดติดต่อนิติบุคคล
                        </div>
                        @else
                    <button type="submit" class="btn btn-outline-success">Invite</button>
                        @endif
                </form>
{{--                <p><a href="http://www.cakecounter.com/" style="color:#00ffe9;" target="_blank">All our modules are designed to play nicely with responsive of course. At the end of the day it comes down to the theme you use - our code doesn't get in your way.</a></p>--}}
            </div>

        </div>
    </div>
    @endsection
